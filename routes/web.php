<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendshipController;
use Illuminate\Support\Facades\Route;

Route::get('registro', [LoginController::class, 'registerForm']);
Route::post('registro', [LoginController::class, 'register'])->name('registro');
Route::get('login', [LoginController::class, 'loginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('cuenta', function(){
    return view('auth.account');
})->name('users.account')
->middleware('auth');

Route::get('/users/search', 'App\Http\Controllers\UserController@search')->name('users.search');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/friends/{user}', [App\Http\Controllers\FriendshipController::class, 'sendRequest'])->name('friendship.sendRequest');
Route::delete('/friendship/{user}/cancel', [App\Http\Controllers\FriendshipController::class, 'cancelRequest'])->name('friendship.cancelRequest');
Route::delete('/friends/{user}', [FriendshipController::class, 'deleteFriend'])->name('friendship.deleteFriend');


Route::post('/friendship/accept/{user}', [FriendshipController::class, 'acceptRequest'])->name('friendship.acceptRequest');
Route::patch('/friendship/{user}/reject', [FriendshipController::class, 'rejectRequest'])->name('friendship.rejectRequest');

Route::get('/pictures/{userId}', [PictureController::class, 'index'])->name('pictures.index');

Route::post('users/{user}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('messages', MessageController::class);
Route::resource('pictures', PictureController::class);

