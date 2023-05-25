<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\BookingController;

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
Route::resource('users', UserController::class)->only(['edit', 'destroy'])->middleware('auth');
Route::get('/users/{id}/follow', [UserController::class, 'follow'])->name('follow')->middleware('auth');
Route::get('/users/{id}/follow', [UserController::class, 'follow'])->name('follow')->middleware('auth');
Route::get('/users/{id}/changeRole', [UserController::class, 'changeRole'])->name('changeRole')->middleware('auth');
Route::post('/users/upload-avatar', [UserController::class, 'uploadAvatar'])->name('upload.avatar');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update')->middleware('auth');

Route::resource('events', EventController::class)->only(['index']);
Route::resource('events', EventController::class)->only(['create', 'store', 'edit', 'destroy'])->middleware('auth');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update')->middleware('auth');

Route::resource('publications', PublicationController::class)->only(['index']);
Route::resource('publications', PublicationController::class)->only(['create', 'store', 'edit', 'destroy'])->middleware('auth');
Route::put('/publications/{id}', [PublicationController::class, 'update'])->name('publications.update')->middleware('auth');

Route::resource('contactMessages', ContactMessageController::class)->only(['index', 'create', 'store']);
Route::resource('contactMessages', ContactMessageController::class)->only(['show', 'destroy'])->middleware('auth');

Route::get('/chat', [ChatController::class, 'index'])->name('chats.index')->middleware('auth');
Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chats.show')->middleware('auth');
Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chats.sendMessage')->middleware('auth');

Route::resource('bookings', BookingController::class)->only(['index', 'store', 'destroy'])->middleware('auth');
