<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Auth::user()
        ->photos()
        ->when(request('awarded') == 'true', fn ($query) => $query->whereHas('awards'))
        ->with('category', 'awards')
        ->orderByDesc('submitted_at')
        ->paginate(10)
        ->withQueryString();
        // $items = Photo::with('category', 'owner', 'awards')->orderByDesc('created_at')->paginate(10);
        return inertia(
            "Photo/Index",
            [
                'photos' => $items,
                'filters' => request()->only(['awarded']),
            ]
        );

        
        // return inertia(
        //     "Photo/Index",
        //     [
        //         'photos' => Photo::with('category','owner')->orderByDesc('created_at')->paginate(10)
        //     ]
        // );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Photo::class);
        return inertia("Photo/Create", [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        //$path = $request->file('image')->storePublicly('photos','public');
        $path = Storage::put('photos', $request->file('image'));
        $request->user()->photos()->create([
            //'name' => $request->name,
            'name' => $request->file('image')->hashName(),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => Storage::url($path)
        ]);
        return redirect()->route('dashboard')
            ->banner('Photo created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        // if (Auth::user()->cannot('view', $photo)) {
        //     abort(403);
        // }
        //$this->authorize('view', $photo);
        return inertia(
            "Photo/Show",
            [
                'photo' => $photo
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return inertia(
            "Photo/Edit",
            [
                'photo' => $photo
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $photo->update(
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'description' => ['required', 'string', 'max:255'],
                'image' => ['required', 'string', 'max:1024'],
            ])
        );
        return redirect()->route('user.photo.index')
            ->with('success', 'Photo updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->back()
            ->with('success', 'Photo deleted successfully!');
    }
}
