<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserPhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show'])
    ->middleware('auth');

Route::resource('photo', PhotoController::class)
    //->only('create', 'store', 'edit', 'update', 'destroy')
    ->middleware('auth');

//Route::resource('photo', PhotoController::class)
//    ->except('create', 'store', 'edit', 'update', 'destroy');

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::get('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only('update','create','store')
    ->middleware('auth');;
Route::get('user-account/edit', [UserAccountController::class, 'edit'])
    ->name('user-account.edit')
    ->middleware('auth');;

Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function() {
        Route::resource('photo', UserPhotoController::class)->only('index', 'create', 'store');
    });
