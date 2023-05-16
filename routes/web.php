<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::resource('users', UserController::class)->only(['index', 'show', 'search']);
Route::resource('users', UserController::class)->only(['edit', 'update', 'destroy'])->middleware('auth');
Route::get('/users/search', 'UserController@search')->name('users.search');
Route::get('/users/{id}/changeRole', 'UserController@changeRole')->name('users.changeRole')->middleware('auth');
// Route::get('/users/{username}/search', 'UserController@search')->name('users.search');

Route::resource('events', EventController::class)->only(['index']);
Route::resource('events', EventController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');

Route::resource('publications', PublicationController::class)->only(['index']);
Route::resource('publications', PublicationController::class)->only(['create', 'store', 'edit', 'update', 'destroy'])->middleware('auth');

Route::resource('contactMessages', ContactMessageController::class)->only(['index', 'create', 'store']);
Route::resource('contactMessages', ContactMessageController::class)->only(['show', 'destroy'])->middleware('auth');