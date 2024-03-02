<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class ClubPhotocontroller extends Controller
{

    private function testCountOfPhotos($startDate, $endDate) {
        $photo_count = Photo::query()
            ->whereBetween('submitted_at', [$startDate, $endDate])
            ->count();
        return $photo_count;
    }

    private function handleProvidedDates($startDate, $endDate) {
        $startDate = Carbon::parse($startDate['year'] . "-" . $startDate['month'] +1 . "-01")->format('Y-m-d');

        if ($endDate == null) {
            $endDate = Carbon::parse($startDate)->endOfMonth()->format('Y-m-d');
        } else {
            $endDate = Carbon::parse($endDate['year'] . "-" . $endDate['month'] +1 . "-01")->endOfMonth()->format('Y-m-d');
        }

        return [$startDate, $endDate];
    }

    private function handleNonProvidedDates($startDate) {
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        if ($this->testCountOfPhotos($startDate, $endDate) < 3) {
            $startDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::parse($startDate)->endOfMonth()->format('Y-m-d');
        }
        return [$startDate, $endDate];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startDate_request = request('startDate') ?? null;
        $endDate_request = request('endDate') ?? null;

        $startDate = null;
        $endDate = null;

        if ($startDate_request != null) {
            [$startDate, $endDate] = $this->handleProvidedDates($startDate_request, $endDate_request);
        } else {
            [$startDate, $endDate] = $this->handleNonProvidedDates($startDate_request);
        }

        $startDate_filter['year'] = Carbon::parse($startDate)->format('Y');
        $startDate_filter['month'] = Carbon::parse($startDate)->format('m')-1;
        $endDate_filter['year'] = Carbon::parse($endDate)->format('Y');
        $endDate_filter['month'] = Carbon::parse($endDate)->format('m')-1;

        request()->merge(['startDate' => $startDate_filter]);
        request()->merge(['endDate' => $endDate_filter]);

        $paginate = request('paginate') ?? 10;

        return inertia('ClubPhotos/Index', [
            'photos' => Photo::query()
                ->when(request('awarded') == 'true', fn ($query) => $query->whereHas('awards'))
                ->when($startDate && $endDate, fn ($query) => $query->whereBetween('submitted_at', [$startDate, $endDate]))
                ->when(request('category'), fn ($query) => $query->whereHas('category', fn ($query) => $query->where('name', request('category'))))
                ->when(request('photographer'), function ($query, $photographer) {
                    $query->whereHas('owner', function ($query) use ($photographer) {
                        $query->where('name', 'like', "%{$photographer}%");
                    });
                })
                ->with('owner', 'category', 'awards')
                ->orderByDesc('submitted_at')
                ->paginate($paginate)
                ->withQueryString(),
            'filters' => request()->only(['awarded','startDate','endDate','category','photographer','paginate']),
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
