<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Photo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Home', [
        'photos' => \App\Models\Photo::where('created_at','>',now()->subDays(14)->endOfDay())->get(),
        'canLogin' => Route::has('login'),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About', [
        'canLogin' => Route::has('login'),
    ]);
})->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/competition', function () {
        return Inertia::render('Dashboard');
    })->name('competition');
    Route::get('/submission', function () {
        return Inertia::render('Dashboard');
    })->name('submission');
    Route::get('/barometer', function () {
        return Inertia::render('Dashboard');
    })->name('barometer');
    Route::get('/clubstats', function () {
        return Inertia::render('Dashboard');
    })->name('clubstats');
    Route::get('/my-photos', function () {
        return Inertia::render('Dashboard');
    })->name('my-photos');
});
