<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Photo::class, 'photo');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia(
            "Photo/Index",
            [
                'photos' => Photo::orderByDesc('created_at')->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Photo::class);
        return inertia("Photo/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $path = $request->file('image')->store('public/photos');
        $request->user()->photos()->create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => Storage::url($path)
        ]);
        return redirect()->route('user.photo.index')
            ->with('success', 'Photo submitted successfully!');
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
