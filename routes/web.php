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

Route::get('/solicitud', [App\Http\Controllers\smantenimientoController::class, 'getItems']);

Route::get('/solicitud/insert', [App\Http\Controllers\smantenimientoController::class, 'insertMantenimiento'])->name('insertMantenimiento');


Auth::routes(['verify' => true]);

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

//RUTAS CORREOS
Route::get('/home/correos', [App\Http\Controllers\usuariosController::class, 'getCorreos'])->name('getListaCorreos');

Route::get('/home/correos/editar/{id}', [App\Http\Controllers\usuariosController::class, 'getDatosCorreo'])->name('editarCorreo');

Route::put('/home/correos/update/{id}', [App\Http\Controllers\usuariosController::class, 'updateCorreo'])->name('actualizarCorreo');

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

Route::get('/home/permisos/generar/email/{id}', [App\Http\Controllers\spermisoController::class, 'sendEmailPermiso'])->name('generarCorreoPermiso');

Route::get('/permiso/aprobar/{id}', [App\Http\Controllers\spermisoController::class, 'aprobarSolicitudper']);

Route::get('/permiso/rechazar/{id}', [App\Http\Controllers\spermisoController::class, 'rechazarSolicitudper']);

//RUTAS MODULO PERSONAS
Route::get('/home/personas', [App\Http\Controllers\personaController::class, 'getPersona'])->name('getListaPersonas');

Route::get('/home/persona/nuevo', [App\Http\Controllers\personaController::class, 'nuevoPersona'])->name('nuevoPersona');

Route::get('/home/persona/search/{id}', [App\Http\Controllers\personaController::class, 'getDatosPersona'])->name('editarPersona');

Route::put('/home/persona/update/{id}]', [App\Http\Controllers\personaController::class, 'updateDatosPersona'])->name('actualizarPersona');

Route::put('/home/persona/direccion/new/{id}', [App\Http\Controllers\personaController::class, 'insertDireccion'])->name('agregarDireccion');

Route::get('/home/persona/direccion/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deleteDireccion'])->name('eliminarDireccion');

Route::put('/home/persona/telefono/new/{id}', [App\Http\Controllers\personaController::class, 'insertTelefono'])->name('agregarTelefono');

Route::get('/home/persona/telefono/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deleteTelefono'])->name('eliminarTelefono');

Route::put('/home/compras/insert/new', [App\Http\Controllers\personaController::class, 'insertPersona'])->name('agregarPersona');

Route::get('/home/persona/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deletePersona'])->name('eliminarPersona');


//RUTAS DE SOLICITUD DE MANTENIMIENTO
Route::get('/home/solicitud', [App\Http\Controllers\smantenimientoController::class, 'getSolicitud'])->name('getListaSolicitud');

Route::get('/home/solicitud/search/{id}', [App\Http\Controllers\smantenimientoController::class, 'getDatosSolicitud'])->name('editarSolicitud');

Route::get('/home/solicitud/eliminar/{id}', [App\Http\Controllers\smantenimientoController::class, 'deleteSolicitud'])->name('eliminarSolicitud');

//RUTAS MODULO MANTENIMIENTO
Route::get('/home/mantenimiento', [App\Http\Controllers\mantenimientoController::class, 'getMantenimiento'])->name('getListaMantenimiento');

Route::get('/home/mantenimiento/search/{id}', [App\Http\Controllers\mantenimientoController::class, 'getDatosMantenimiento'])->name('editarMantenimiento');

Route::put('/home/mantenimiento/editar/equipo/{id}', [App\Http\Controllers\mantenimientoController::class, 'updateMantenimiento'])->name('actualizarMantenimiento');

Route::get('/home/mantenimiento/eliminar/{id}', [App\Http\Controllers\mantenimientoController::class, 'deleteMantenimiento'])->name('eliminarMantenimiento');


//RUTAS SOLICITUD APROBACIONDE COMPRA
Route::get('/home/aprobacion', [App\Http\Controllers\sapbcompraController::class, 'getAprobacion'])->name('getListaAprobacion');

Route::get('/home/aprobacion/search/{id}', [App\Http\Controllers\sapbcompraController::class, 'getDatosAprobacion'])->name('editarAprobacion');

Route::put('/home/aprobacion/update/{id}', [App\Http\Controllers\sapbcompraController::class, 'updateAprobacion'])->name('actualizarAprobacion');

Route::get('/home/aprobacion/eliminar/{id}', [App\Http\Controllers\sapbcompraController::class, 'deleteAprobacion'])->name('eliminarAprobacion');

Route::get('/home/aprobacion/nuevo', [App\Http\Controllers\sapbcompraController::class, 'nuevaAprobacionCompra'])->name('abrirNuevaAprobacion');

Route::put('/home/aprobacion/insert/new/{id}', [App\Http\Controllers\sapbcompraController::class, 'insertAprobacion'])->name('agregarAprobacion');

Route::get('/home/aprobacion/generar/email/{id}', [App\Http\Controllers\sapbcompraController::class, 'sendEmailAprobacion'])->name('generarCorreoAprobacion');

Route::get('/aprobacion/aprobar/{id}', [App\Http\Controllers\sapbcompraController::class, 'aprobarSolicitudapb']);

Route::get('/aprobacion/rechazar/{id}', [App\Http\Controllers\sapbcompraController::class, 'rechazarSolicitudapb']);


//RUTAS SOLICITUD DE COMPRA
Route::get('/home/compras', [App\Http\Controllers\scompraController::class, 'getCompras'])->name('getListaCompras');

Route::get('/home/compras/search/{id}', [App\Http\Controllers\scompraController::class, 'getDatosCompra'])->name('editarCompra');

Route::put('/home/compras/update/{id}', [App\Http\Controllers\scompraController::class, 'updateDatosCompra'])->name('actualizarCompra');

Route::get('/home/compras/eliminar/{id}', [App\Http\Controllers\scompraController::class, 'deleteCompra'])->name('eliminarCompra');

Route::get('/home/compras/nuevo', [App\Http\Controllers\scompraController::class, 'nuevaCompra'])->name('abrirNuevaCompra');

Route::put('/home/compras/insert/new/{id}', [App\Http\Controllers\scompraController::class, 'insertCompra'])->name('agregarCompra');





