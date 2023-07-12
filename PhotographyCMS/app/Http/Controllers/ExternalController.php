<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Photo;
use App\Rules\ValidHCaptcha;

class ExternalController extends Controller
{
    public function index(){
        return inertia('External/Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'photos' => Photo::select('image_path')
                ->orderByDesc('submitted_at')
                ->take(5)
                ->get()
                ->toArray(),
        ]);
    }

    public function email(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'hcaptcha' => ['required',new ValidHCaptcha],
        ]);
    }
}
