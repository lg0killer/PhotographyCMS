<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard',
        [
            'photos' => Photo::all()
        ]);
    }
}
