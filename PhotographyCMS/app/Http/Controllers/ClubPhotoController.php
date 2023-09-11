<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class ClubPhotocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = now();

        $photo_count = Photo::query()
            ->whereYear('submitted_at', $date->format('Y'))
            ->whereMonth('submitted_at', $date->format('m'))
            ->count();
        
        if ($photo_count < 5) {
            $date = $date->subMonth();
        }

        $request = request()->merge([
            'year' => request('year', $date->format('Y')),
            'month' => request('month', $date->format('m')),
        ]);

        return inertia('ClubPhotos/Index', [
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
                ->with('owner', 'category', 'awards')
                ->orderByDesc('submitted_at')
                ->paginate(10)
                ->withQueryString(),
            'filters' => request()->only(['awarded','year','month','category','photographer']),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
