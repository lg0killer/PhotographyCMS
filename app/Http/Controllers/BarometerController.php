<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barometer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarometerController extends Controller
{
    public function index()
    {
        return inertia('Barometer/Index',[
            'barometer' => User::query()
                ->with(['barometers' => function ($query) {
                    $query
                    ->whereYear('month', 2023)
                    ->orderBy('month', 'asc');
                }])
                ->withCount(['barometers as total_points' => function ($query) {
                    $query->select(DB::raw('SUM(points) as points'))
                    ->whereYear('month', 2023);
                }])
                ->orderBy('total_points', 'desc')
                ->paginate(50)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        $request = request()->merge([
            'year' => request('year', now()->format('Y')),
            'month' => request('month', now()->format('m')),
        ]);
        return inertia('Barometer/Create',[
            'user' => User::query()
                ->with(['barometers' => function ($query) {
                    $query
                    ->when(request('year'), fn ($query) => $query->whereYear('month', request('year')))
                    ->when(request('month'), fn ($query) => $query->whereMonth('month', request('month')))
                    ;
                }])
                ->paginate(50)
                ->withQueryString(),
            'filters' => request()->only(['year','month']),
        ]);
    }

    public function store(Request $request)
    {
        $submitted_date = '01-'. $request->month .'-'. $request->year;
        $submitted_date = Carbon::createFromFormat('d-m-Y', $submitted_date)->format('Y-m-d');

        foreach ($request->points as $user_id => $points) {
            DB::table('barometers')
                ->updateOrInsert(
                    ['user_id' => $points['id'], 'month' => $submitted_date],
                    ['points' => $points['points']]
                );
        }

        return redirect()->route('barometer.index')->with('success', 'Barometer created.');
    }
}
