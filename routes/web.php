<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\inventarioController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::view('/','login');

Route::view('/registro','registro');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');

// RUTAS INVENTARIO

Route::get('/home/inventario', [App\Http\Controllers\inventarioController::class, 'getInventario'])->name('getListaEquipos');

Route::get('/home/inventario/nuevo', [App\Http\Controllers\inventarioController::class, 'nuevoEquipo'])->name('nuevoEquipo');

Route::get('/home/inventario/{id}', [App\Http\Controllers\inventarioController::class, 'getDatosEquipo'])->name('editarEquipo');

Route::get('/home/inventario/editar/hola/', [App\Http\Controllers\inventarioController::class, 'actualizar'])->name('actualizarEquipo');
