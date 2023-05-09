<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
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



Route::resource('users', UserController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->only(['edit', 'update', 'destroy']);

Route::resource('events', EventController::class)->only(['index']);
Route::resource('events', EventController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);

Route::resource('publications', EventController::class)->only(['index']);
Route::resource('publications', EventController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);

Route::resource('messages', MessageController::class)->only(['create', 'store']);
Route::resource('messages', MessageController::class)->only(['index', 'show', 'update', 'destroy']);

