<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ClubInformationController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return inertia('ClubInfo/Index',  ['categories' => $categories]);
    }
}
