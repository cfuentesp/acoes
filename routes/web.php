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

Route::view('/roles','roles');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');

//RUTAS USUARIO

Route::get('/home/usuarios', [App\Http\Controllers\usuariosController::class, 'getUsuarios'])->name('getListaUsuarios');

Route::get('/home/usuarios/registro', [App\Http\Controllers\usuariosController::class, 'registroUsuarios'])->name('userRegistro');

Route::get('/home/roles', [App\Http\Controllers\usuariosController::class, 'getRoles'])->name('getListaRoles');

Route::get('/home/roles/nuevo', [App\Http\Controllers\usuariosController::class, 'nuevoRol'])->name('agregarNuevoRol');

Route::put('/home/roles/insert', [App\Http\Controllers\usuariosController::class, 'insertRole'])->name('insertarNuevoRol');

Route::get('/home/roles/permission/{name}/{id}', [App\Http\Controllers\usuariosController::class, 'getPermission'])->name('getListaPermisos');

Route::get('/home/permission/insertPermission/{id}', [App\Http\Controllers\usuariosController::class, 'intertPermission'])->name('insertPermissionRole');

Route::get('/home/usuarios/editar/{name}/{id}', [App\Http\Controllers\usuariosController::class, 'getDatosUsuario'])->name('editarUsuario');

Route::get('/home/usuarios/nuevoRole/{id}', [App\Http\Controllers\usuariosController::class, 'insertRoleUser'])->name('agregarRoleUsuario');

Route::get('/home/usuarios/eliminarRole/{id}', [App\Http\Controllers\usuariosController::class, 'deleteRole'])->name('eliminarRole');

Route::get('/home/usuarios/deleteUser/{id}', [App\Http\Controllers\usuariosController::class, 'deleteUser'])->name('eliminarUsuario');

Route::get('/home/usuarios/createUser', [App\Http\Controllers\usuariosController::class, 'createUser'])->name('crearUsuario');

// RUTAS INVENTARIO

Route::get('/home/inventario', [App\Http\Controllers\inventarioController::class, 'getInventario'])->name('getListaEquipos');

Route::get('/home/inventario/nuevo', [App\Http\Controllers\inventarioController::class, 'nuevoEquipo'])->name('nuevoEquipo');

Route::get('/home/inventario/editar/{id}', [App\Http\Controllers\inventarioController::class, 'getDatosEquipo'])->name('editarEquipo');

Route::put('/home/inventario/actualizar/{id}', [App\Http\Controllers\inventarioController::class, 'updateDatosEquipo'])->name('actualizarEquipo');

Route::put('/home/inventario/insert', [App\Http\Controllers\inventarioController::class, 'insertEquipo'])->name('agregarEquipo');

Route::get('/home/inventario/eliminar/{id}', [App\Http\Controllers\inventarioController::class, 'deleteEquipo'])->name('eliminarEquipo');

//RUTAS DE BITACORA DE MEJORA CONTINUA
Route::get('/home/observacion', [App\Http\Controllers\bitacoraController::class, 'getObservacion'])->name('getListaObservacion');

Route::get('/home/observacion/search/{id}', [App\Http\Controllers\bitacoraController::class, 'getDatosObservacion'])->name('editarObservacion');

Route::get('/home/observacion/update/{id}', [App\Http\Controllers\bitacoraController::class, 'updateDatosObservacion'])->name('actualizarObservacion');

Route::get('/home/observacion/eliminar/{id}', [App\Http\Controllers\bitacoraController::class, 'deleteObservacion'])->name('eliminarObservacion');

Route::get('/home/observacion/nuevo', [App\Http\Controllers\bitacoraController::class, 'nuevoBitacora'])->name('abrirNuevo');

Route::put('/home/observacion/insert/new', [App\Http\Controllers\bitacoraController::class, 'insertObservacion'])->name('agregarObservacion');

//RUTAS DE SOLICITUD DE PERMISOS
Route::get('/home/permisos', [App\Http\Controllers\spermisoController::class, 'getPermisos'])->name('getListaPermisosLaborales');

Route::get('/home/permisos/search/{id}', [App\Http\Controllers\spermisoController::class, 'getDatosPermiso'])->name('editarPermisos');

Route::put('/home/permisos/update/{id}', [App\Http\Controllers\spermisoController::class, 'updateDatosPermiso'])->name('actualizarPermisos');

Route::get('/home/permisos/eliminar/{id}', [App\Http\Controllers\spermisoController::class, 'deletePermiso'])->name('eliminarPermisos');

Route::get('/home/permisos/nuevo', [App\Http\Controllers\spermisoController::class, 'nuevoPermiso'])->name('abrirNuevoPermiso');

Route::put('/home/permisos/insert/new', [App\Http\Controllers\spermisoController::class, 'insertPermiso'])->name('agregarPermiso');





//RUTAS MODULO MANTENIMIENTO
Route::get('/home/mantenimiento', [App\Http\Controllers\MantenimientoController::class, 'getMantenimiento'])->name('getListaMantenimiento');

Route::get('/home/mantenimiento/nuevo', [App\Http\Controllers\MantenimientoController::class, 'nuevoMantenimiento'])->name('abrirNuevoMantenimiento');

Route::get('/home/mantenimiento/search/{id}', [App\Http\Controllers\MantenimientoController::class, 'getDatosMantenimiento'])->name('editarMantenimiento');

Route::put('/home/mantenimiento/editar/{id}{sol}{eq}', [App\Http\Controllers\MantenimientoController::class, 'updateMantenimiento'])->name('actualizarMantenimiento');

Route::get('/home/mantenimiento/eliminar/{id}', [App\Http\Controllers\mantenimientoController::class, 'deleteMantenimiento'])->name('eliminarMantenimiento');

//RUTAS MODULO PERSONAS
Route::get('/home/personas', [App\Http\Controllers\PersonaController::class, 'getPersona'])->name('getListaPersonas');

Route::get('/home/persona/nuevo', [App\Http\Controllers\PersonaController::class, 'nuevoPersona'])->name('nuevoPersona');

Route::get('/home/persona/{id}', [App\Http\Controllers\PersonaController::class, 'getDatosPersona'])->name('editarPersona');

Route::put('/home/persona/{id}]', [App\Http\Controllers\PersonaController::class, 'updateDatosPersona'])->name('actualizarPersona');

