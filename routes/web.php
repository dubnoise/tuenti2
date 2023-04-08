<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

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
Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);


Route::resource('messages', MessageController::class);
Route::resource('pictures', PictureController::class);


