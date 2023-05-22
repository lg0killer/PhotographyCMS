<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class UserPhotoController extends Controller
{
    public function index()
    {
        return inertia(
            "Photo/Index",
            [
                'photos' => Auth::user()->photos()->with('category','owner')->orderByDesc('created_at')->paginate(10),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("User/Photo/Create");
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
}
