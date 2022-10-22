<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Auth;




Route::view('/','welcome');
Route::view('/login','login');
Route::resource('personas','App\Http\Controllers\PersonaController');
Route::view('/','login');

Route::view('/registro','registro');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');
