<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ContactMessageController;

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


Route::get('', function () {
    return view('inicio');
})->name('inicio');

Route::get('registro', [LoginController::class, 'registerForm']);
Route::post('registro', [LoginController::class, 'register'])->name('registro');
Route::get('login', [LoginController::class, 'loginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->only(['edit', 'update', 'destroy', 'uploadAvatar'])->middleware('auth');
Route::get('/users/{id}/follow', [UserController::class, 'follow'])->name('follow')->middleware('auth');
Route::get('/users/{id}/follow', [UserController::class, 'follow'])->name('follow')->middleware('auth');
Route::get('/users/{id}/changeRole', [UserController::class, 'changeRole'])->name('changeRole')->middleware('auth');

Route::resource('events', EventController::class)->only(['index']);
Route::resource('events', EventController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');

Route::resource('publications', PublicationController::class)->only(['index']);
Route::resource('publications', PublicationController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');

Route::resource('contactMessages', ContactMessageController::class)->only(['index', 'create', 'store']);
Route::resource('contactMessages', ContactMessageController::class)->only(['show', 'destroy'])->middleware('auth');


Route::resource('bookings', BookingMessageController::class)->only(['index', 'create', 'store', 'destroy'])->middleware('auth');
