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
            "Dashboard",
            [
                'photos' => Auth::user()->photos()->with('category','owner')->orderByDesc('created_at')->paginate(3),
                'submittedPhotos' => [],
            ]
        );
    }
}
