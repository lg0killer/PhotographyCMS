<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UserPhotoController::class, 'index'])->name('dashboard');
    Route::resource('photo', PhotoController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admins'
])  ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('dashboard', [IndexController::class, 'index']) ->name('dashboard');
    Route::resource('category', CategoryController::class);
});



//Route::middleware(['auth:sanctum', 'verified'])->resource('/photo', PhotoController::class);

// Route::resource('photo', PhotoController::class)
//     //->only('create', 'store', 'edit', 'update', 'destroy')
//     ->middleware('auth');

//Route::resource('photo', PhotoController::class)
//    ->except('create', 'store', 'edit', 'update', 'destroy');

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::get('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function() {
        Route::resource('photo', UserPhotoController::class)->only('index', 'create', 'store');
    });