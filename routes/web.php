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

Route::put('/home/inventario/{id}', [App\Http\Controllers\inventarioController::class, 'updateDatosEquipo'])->name('actualizarEquipo');

Route::put('/home/inventario/nuevo', [App\Http\Controllers\inventarioController::class, 'insertEquipo'])->name('agregarEquipo');

Route::get('/home/inventario/eliminar/{id}', [App\Http\Controllers\inventarioController::class, 'deleteEquipo'])->name('eliminarEquipo');


//RUTAS MODULO PERSONAS
Route::get('/home/personas', [App\Http\Controllers\PersonaController::class, 'getPersona'])->name('getListaPersonas');

Route::get('/home/persona/nuevo', [App\Http\Controllers\PersonaController::class, 'nuevoPersona'])->name('nuevoPersona');

Route::get('/home/persona/{id}', [App\Http\Controllers\PersonaController::class, 'getDatosPersona'])->name('editarPersona');

Route::put('/home/persona/{id}]', [App\Http\Controllers\PersonaController::class, 'updateDatosPersona'])->name('actualizarPersona');

//RUTAS DE BITACORA DE MEJORA CONTINUA
Route::get('/home/observacion', [App\Http\Controllers\observacionController::class, 'getObservacion'])->name('getListaObservacion');

Route::get('/home/observacion/search{id}', [App\Http\Controllers\observacionController::class, 'getDatosObservacion'])->name('editarObservacion');

Route::put('/home/observacion/update/{id}', [App\Http\Controllers\observacionController::class, 'updateDatosObservacion'])->name('actualizarObservacion');

Route::get('/home/observacion/eliminar/{id}', [App\Http\Controllers\observacionController::class, 'deleteObservacion'])->name('eliminarObservacion');

Route::get('/home/observacion/nuevo', [App\Http\Controllers\observacionController::class, 'nuevoBitacora'])->name('abrirNuevo');

Route::put('/home/observacion/insert', [App\Http\Controllers\observacionController::class, 'insertObservacion'])->name('agregarObservacion');
