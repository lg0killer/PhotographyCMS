<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserVaultController;
use App\Http\Controllers\ClubPhotoController;
use App\Http\Controllers\AdminPhotoController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\BarometerController;
use App\Http\Controllers\DashboardController;
use App\Models\Photo;
use RahulHaque\Filepond\Facades\Filepond;
use App\Jobs\SendSubmissionEmail;
use App\Http\Controllers\EmailAuditController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonthlySubmission;

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
//     return Inertia::render('External/Home', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'photos' => Photo::all()->order ->take(10)->pluck('image'),
//     ]);
// })->name('home');


Route::get('/', [ExternalController::class, 'index'])
    ->name('home');
Route::post('/', [ExternalController::class, 'email'])
    ->name('email');


//User routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard',['photos' => Photo::all()]);
    // })->name('dashboard');
    Route::resource('dashboard', DashboardController::class)->only('index');
    Route::resource('vault', UserVaultController::class);
    Route::resource('photo', PhotoController::class)->only('index');
    Route::resource('clubphoto', ClubPhotoController::class);
    Route::resource('barometer', BarometerController::class)->only('index','create','store');
});

//Admin routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admins'
])  ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('user', AdminUserController::class);
    Route::resource('photo', AdminPhotoController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('emailaudit', EmailAuditController::class)->only('index','show');
});

Route::get('test-email', function() {
    //SendSubmissionEmail::dispatch();
    Mail::send(new MonthlySubmission);
    dd('Message sent');
});
