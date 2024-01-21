<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\StarLevel;
use App\Models\User;
use App\Models\Award;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use RahulHaque\Filepond\Facades\Filepond;


class AdminPhotoController extends Controller
{
    public function index()
    {
        return inertia('Admin/Photo/Index',[
            'photos' => Photo::query()
                ->when(request('awarded') == 'true', fn ($query) => $query->whereHas('awards'))
                ->when(request('year'), fn ($query) => $query->whereYear('submitted_at', request('year')))
                ->when(request('month'), fn ($query) => $query->whereMonth('submitted_at', request('month')))
                ->when(request('category'), fn ($query) => $query->whereHas('category', fn ($query) => $query->where('name', request('category'))))
                ->when(request('photographer'), function ($query, $photographer) {
                    $query->whereHas('owner', function ($query) use ($photographer) {
                        $query->where('name', 'like', "%{$photographer}%");
                    });
                })
                ->with('category', 'owner', 'awards')
                ->orderByDesc('created_at')
                ->paginate(10)
                ->withQueryString(),
            'filters' => request()->only(['awarded','year','month','category','photographer']),
            'categories' => Category::all(),
            'total_photos' => Photo::count(),
        ]);
    }

    public function create()
    {
        return inertia('Admin/Photo/Create', [
            'awards' => Award::all(),
        ]);
    }

    public function store(Request $request)
    {
        $errors = [];
        if ($request->hasFile('images')) {
            $request->validate([
                'images' => ['required', 'array', 'max:100'],
            ],);

            $category = Category::all();

            foreach ($request->file('images') as $index =>$image) {
                try {
                    $filename = $request->image_names[$index];
                    $filename = pathinfo($filename, PATHINFO_FILENAME);
                    $star_level = Str::upper(explode("_", $filename)[0]);
                    $category_shortcode = Str::upper(explode("_", $filename)[1]);                    
                    $image_name = explode("_", $filename)[2];

                    $score = $request->image_scores[$index];

                    $author_name = explode("_", $filename)[3];
                    $author_name = str_replace("copy", "", $author_name);
                    $author_name = explode(".", $author_name)[0];
                    $author_name = trim($author_name);

                    $submitted_date = $request->month .'-'. $request->year;
                    $submitted_date = Carbon::createFromFormat('m-Y', $submitted_date)->format('Y-m-d');

                    // $awards = collect($request->image_awards[$index])->unique()->toArray();
                    $awards = [];

                    $validator = Validator::make([
                        'image_name' => $image_name,
                        'category_shortcode' => $category_shortcode,
                        'author_name' => $author_name,
                        'images' => $image,
                        'date' => $submitted_date,
                        'star_level' => $star_level,
                        'score' => $score,
                        'awards' => $request->awards,
                    ],[
                        'image_name' => 'required|string|max:255',
                        'category_shortcode' => 'required|string|max:255',
                        'author_name' => 'required|string|max:255',
                        'images' => 'required|image|max:2048',
                        'date' => 'required|date',
                        'star_level' => 'required|string|max:2',
                        'score' => 'required|integer|min:0|max:15',
                        'awards' => 'array|exists:awards,id',
                    ]);

                    $author = User::where('name', $author_name)->first();

                    $starLevel = StarLevel::where('name', $star_level)->first();

                    if (Str::startsWith($category_shortcode, 'C'))
                        $category_id = $category->where('short_code', 'C')->first()->id;
                    else
                        $category_id = $category->where('short_code', $category_shortcode)->first()->id;
                    
                    //$path = Storage::put('photos', $image);
                    
                    //$path = Storage::store()

                    if ($author)
                    {
                        $path = Storage::putFile('photos', $image,'public');
                        $author->photos()->create([
                            'name' => $image_name,
                            'description' => 'asdasdas',
                            'category_id' => $category_id,
                            'image_path' => $path,
                            'image' => Storage::url($path),
                            'submitted_at' => $submitted_date,
                            'starlevel_id' => $starLevel->id,
                            'original_name' => $image->getClientOriginalName(),
                            'score' => $score,
                            'awards' => $awards,
                        ]);
                    }
                    else
                        // raise exception if author does not exist
                        throw new \Exception('Author does not exist');
                } catch (\Exception $e) {
                    $errors = Arr::add($errors, $image_name, $e->getMessage());
                }

            }           
            if (count($errors) > 0)
                return redirect()->back()->withErrors($errors);
            return redirect(route('admin.photo.index'))->banner('success', 'Photos uploaded successfully');
        }            
    }

    public function edit(Photo $photo)
    {
        return inertia('Admin/Photo/Edit', [
            //'photo' => Photo::query()->with('category', 'owner', 'awards')->where('id',$photo),
            'photo' => $photo->load('category', 'owner', 'awards'),
            'awards' => Award::all(),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Photo $photo)
    {
        $category_id = Category::where('name', $request->category)->first()->id;
        $submitted_at = Carbon::createFromFormat('m Y', $request->submitted_at)->format('Y-m-d');
        $request->merge([
            'category_id' => $category_id,
            'submitted_at' => $submitted_at,
        ]);
        
        $request->validate([
            'name' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'awards' => ['array', 'exists:awards,id'],
            'score' => 'integer|min:0|max:15',
            'submitted_at' => 'required|date_format:Y-m-d',
        ], [
            'score.numeric' => 'You can only submit a score beteen 0 and 15' . $request->score,
            'submitted_at.date' => 'The submitted at does not match the format m Y. is currently ' . $request->submitted_at,
        ]);

        $awards = collect($request->awards)->unique()->toArray();
        $photo->awards()->sync($awards);
        $photo->update($request->all());

        return redirect()->route('admin.photo.index')->banner('Photo updated.');
    }

    public function destroy(Photo $photo)
    {
        $photo->awards()->detach();
        $photo->delete();
        return redirect()->back()
            ->with('success', 'Photo deleted successfully!');
    }
}
