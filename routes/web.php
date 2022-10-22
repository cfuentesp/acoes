<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\PersonaController;
=======
use Illuminate\Support\Facades\Auth;



>>>>>>> cfa762ceb7d827e44cedb394c5702771f02ced92

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

<<<<<<< HEAD
Route::view('/','welcome');
Route::view('/login','login');
Route::resource('personas','App\Http\Controllers\PersonaController');
=======
Route::view('/','login');

Route::view('/registro','registro');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');
>>>>>>> cfa762ceb7d827e44cedb394c5702771f02ced92
