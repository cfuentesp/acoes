<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PersonaController;
use App\Http\Controllers\inventarioController;
use App\Http\Controllers\mantenimientoController;





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

//RUTAS MODULO PERSONAS
Route::get('/home/persona', [App\Http\Controllers\HomeController::class, 'getPersona'])->name('home/persona');
Route::get('/home/persona/nuevo', [App\Http\Controllers\PersonaController::class, 'nuevoPersona'])->name('nuevoPersona');
Route::get('/home/persona/{id}', [App\Http\Controllers\PersonaController::class, 'getDatosPersona'])->name('editarPersona');
Route::get('/home/persona/editar/hello/', [App\Http\Controllers\PersonaController::class, 'actualizar'])->name('actualizarPersona');

//Route::resource('/personas','App\Http\Controllers\PersonaController');


//RUTAS MODULO MANTENIMIENTO
Route::get('/home/mantenimiento', [App\Http\Controllers\HomeController::class, 'getMantenimiento'])->name('home/mantenimiento');
Route::get('/home/mantenimiento/nuevo', [App\Http\Controllers\mantenimientoController::class, 'nuevoMantenimiento'])->name('nuevoMantenimiento');
Route::get('/home/mantenimiento/{id}', [App\Http\Controllers\mantenimientoController::class, 'getDatosMantenimiento'])->name('editarMantenimiento');
Route::get('/home/mantenimiento/editar/hello/', [App\Http\Controllers\mantenimientoController::class, 'actualizar'])->name('actualizarMantenimiento');


//
Auth::routes();

Route::get('/home/inventario', [App\Http\Controllers\HomeController::class, 'getInventario'])->name('home/inventario');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');

// RUTAS INVENTARIO

Route::get('/home/inventario', [App\Http\Controllers\inventarioController::class, 'getInventario'])->name('getListaEquipos');

Route::get('/home/inventario/nuevo', [App\Http\Controllers\inventarioController::class, 'nuevoEquipo'])->name('nuevoEquipo');

Route::get('/home/inventario/{id}', [App\Http\Controllers\inventarioController::class, 'getDatosEquipo'])->name('editarEquipo');


Route::get('/home/inventario/editar/hola/', [App\Http\Controllers\inventarioController::class, 'actualizar'])->name('actualizarEquipo');


Route::put('/home/inventario/{id}', [App\Http\Controllers\inventarioController::class, 'updateDatosEquipo'])->name('actualizarEquipo');

