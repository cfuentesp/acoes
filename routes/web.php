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

Route::get('home/new/solicitud', [App\Http\Controllers\smantenimientoController::class, 'getItems'])->name('smantenimientoNew')->middleware('auth');

Route::get('home/new/solicitud/insert', [App\Http\Controllers\smantenimientoController::class, 'insertMantenimiento'])->name('insertMantenimiento')->middleware('auth');


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutt');

//RUTAS USUARIO

Route::get('/home/usuarios', [App\Http\Controllers\usuariosController::class, 'getUsuarios'])->name('getListaUsuarios')->middleware('auth');

Route::get('/home/usuarios/registro', [App\Http\Controllers\usuariosController::class, 'registroUsuarios'])->name('userRegistro')->middleware('auth');

Route::get('/home/roles/lista/', [App\Http\Controllers\usuariosController::class, 'getRoles'])->name('getListaRoles')->middleware('auth');

Route::get('/home/roles/nuevo/', [App\Http\Controllers\usuariosController::class, 'nuevoRol'])->name('agregarNuevoRol')->middleware('auth');

Route::put('/home/roles/insert/new', [App\Http\Controllers\usuariosController::class, 'insertRole'])->name('insertarNuevoRol')->middleware('auth');

Route::get('/home/roles/permission/{name}/{id}', [App\Http\Controllers\usuariosController::class, 'getPermission'])->name('getListaPermisos')->middleware('auth');

Route::get('/home/permission/insertPermission/{id}', [App\Http\Controllers\usuariosController::class, 'intertPermission'])->name('insertPermissionRole')->middleware('auth');

Route::get('/home/usuarios/editar/{name}/{id}', [App\Http\Controllers\usuariosController::class, 'getDatosUsuario'])->name('editarUsuario')->middleware('auth');

Route::get('/home/usuarios/nuevoRole/{id}', [App\Http\Controllers\usuariosController::class, 'insertRoleUser'])->name('agregarRoleUsuario')->middleware('auth');

Route::get('/home/usuarios/eliminarRole/{id}', [App\Http\Controllers\usuariosController::class, 'deleteRole'])->name('eliminarRole')->middleware('auth');

Route::get('/home/usuarios/deleteUser/{id}', [App\Http\Controllers\usuariosController::class, 'deleteUser'])->name('eliminarUsuario')->middleware('auth');

Route::get('/home/usuarios/createUser', [App\Http\Controllers\usuariosController::class, 'createUser'])->name('crearUsuario')->middleware('auth');

Route::get('/home/usuarios/update/password/{id}', [App\Http\Controllers\usuariosController::class, 'updatePasswordUser'])->name('actualizarContraseniaUser')->middleware('auth');

//RUTAS CORREOS
Route::get('/home/correos', [App\Http\Controllers\usuariosController::class, 'getCorreos'])->name('getListaCorreos')->middleware('auth');

Route::get('/home/correos/editar/{id}', [App\Http\Controllers\usuariosController::class, 'getDatosCorreo'])->name('editarCorreo')->middleware('auth');

Route::put('/home/correos/update/{id}', [App\Http\Controllers\usuariosController::class, 'updateCorreo'])->name('actualizarCorreo')->middleware('auth');

// RUTAS INVENTARIO

Route::get('/home/inventario', [App\Http\Controllers\inventarioController::class, 'getInventario'])->name('getListaEquipos')->middleware('auth');

Route::get('/home/inventario/nuevo', [App\Http\Controllers\inventarioController::class, 'nuevoEquipo'])->name('nuevoEquipo')->middleware('auth');

Route::get('/home/inventario/editar/{id}', [App\Http\Controllers\inventarioController::class, 'getDatosEquipo'])->name('editarEquipo')->middleware('auth');

Route::put('/home/inventario/actualizar/{id}', [App\Http\Controllers\inventarioController::class, 'updateDatosEquipo'])->name('actualizarEquipo')->middleware('auth');

Route::put('/home/inventario/insert', [App\Http\Controllers\inventarioController::class, 'insertEquipo'])->name('agregarEquipo')->middleware('auth');

Route::get('/home/inventario/eliminar/{id}', [App\Http\Controllers\inventarioController::class, 'deleteEquipo'])->name('eliminarEquipo')->middleware('auth');

//RUTAS DE BITACORA DE MEJORA CONTINUA
Route::get('/home/observacion', [App\Http\Controllers\bitacoraController::class, 'getObservacion'])->name('getListaObservacion')->middleware('auth');

Route::get('/home/observacion/search/{id}', [App\Http\Controllers\bitacoraController::class, 'getDatosObservacion'])->name('editarObservacion')->middleware('auth');

Route::get('/home/observacion/update/{id}', [App\Http\Controllers\bitacoraController::class, 'updateDatosObservacion'])->name('actualizarObservacion')->middleware('auth');

Route::get('/home/observacion/eliminar/{id}', [App\Http\Controllers\bitacoraController::class, 'deleteObservacion'])->name('eliminarObservacion')->middleware('auth');

Route::get('/home/observacion/nuevo', [App\Http\Controllers\bitacoraController::class, 'nuevoBitacora'])->name('abrirNuevo')->middleware('auth');

Route::put('/home/observacion/insert/new', [App\Http\Controllers\bitacoraController::class, 'insertObservacion'])->name('agregarObservacion')->middleware('auth');

//RUTAS DE SOLICITUD DE PERMISOS
Route::get('/home/permisos', [App\Http\Controllers\spermisoController::class, 'getPermisos'])->name('getListaPermisosLaborales')->middleware('auth');

Route::get('/home/permisos/search/{id}', [App\Http\Controllers\spermisoController::class, 'getDatosPermiso'])->name('editarPermisos')->middleware('auth');

Route::put('/home/permisos/update/{id}', [App\Http\Controllers\spermisoController::class, 'updateDatosPermiso'])->name('actualizarPermisos')->middleware('auth');

Route::get('/home/permisos/eliminar/{id}', [App\Http\Controllers\spermisoController::class, 'deletePermiso'])->name('eliminarPermisos')->middleware('auth');

Route::get('/home/permisos/nuevo', [App\Http\Controllers\spermisoController::class, 'nuevoPermiso'])->name('abrirNuevoPermiso')->middleware('auth');

Route::put('/home/permisos/insert/new', [App\Http\Controllers\spermisoController::class, 'insertPermiso'])->name('agregarPermiso')->middleware('auth');

Route::get('/home/permisos/generar/email/{id}', [App\Http\Controllers\spermisoController::class, 'sendEmailPermiso'])->name('generarCorreoPermiso')->middleware('auth');

Route::get('/permiso/aprobar/{id}', [App\Http\Controllers\spermisoController::class, 'aprobarSolicitudper']);

Route::get('/permiso/rechazar/{id}', [App\Http\Controllers\spermisoController::class, 'rechazarSolicitudper']);

//RUTAS MODULO PERSONAS
Route::get('/home/personas', [App\Http\Controllers\personaController::class, 'getPersona'])->name('getListaPersonas')->middleware('auth');

Route::get('/home/persona/nuevo', [App\Http\Controllers\personaController::class, 'nuevoPersona'])->name('nuevoPersona')->middleware('auth');

Route::get('/home/persona/search/{id}', [App\Http\Controllers\personaController::class, 'getDatosPersona'])->name('editarPersona')->middleware('auth');

Route::put('/home/persona/update/{id}]', [App\Http\Controllers\personaController::class, 'updateDatosPersona'])->name('actualizarPersona')->middleware('auth');

Route::put('/home/persona/direccion/new/{id}', [App\Http\Controllers\personaController::class, 'insertDireccion'])->name('agregarDireccion')->middleware('auth');

Route::get('/home/persona/direccion/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deleteDireccion'])->name('eliminarDireccion')->middleware('auth');

Route::put('/home/persona/telefono/new/{id}', [App\Http\Controllers\personaController::class, 'insertTelefono'])->name('agregarTelefono')->middleware('auth');

Route::get('/home/persona/telefono/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deleteTelefono'])->name('eliminarTelefono')->middleware('auth');

Route::put('/home/compras/insert/new', [App\Http\Controllers\personaController::class, 'insertPersona'])->name('agregarPersona')->middleware('auth');

Route::get('/home/persona/eliminar/{id}', [App\Http\Controllers\personaController::class, 'deletePersona'])->name('eliminarPersona')->middleware('auth');


//RUTAS DE SOLICITUD DE MANTENIMIENTO
Route::get('/home/solicitud', [App\Http\Controllers\smantenimientoController::class, 'getSolicitud'])->name('getListaSolicitud')->middleware('auth');

Route::get('/home/solicitud/search/{id}', [App\Http\Controllers\smantenimientoController::class, 'getDatosSolicitud'])->name('editarSolicitud')->middleware('auth');

Route::get('/home/solicitud/eliminar/{id}', [App\Http\Controllers\smantenimientoController::class, 'deleteSolicitud'])->name('eliminarSolicitud')->middleware('auth');

//RUTAS MODULO MANTENIMIENTO
Route::get('/home/mantenimiento', [App\Http\Controllers\mantenimientoController::class, 'getMantenimiento'])->name('getListaMantenimiento')->middleware('auth');

Route::get('/home/mantenimiento/search/{id}', [App\Http\Controllers\mantenimientoController::class, 'getDatosMantenimiento'])->name('editarMantenimiento')->middleware('auth');

Route::put('/home/mantenimiento/editar/equipo/{id}', [App\Http\Controllers\mantenimientoController::class, 'updateMantenimiento'])->name('actualizarMantenimiento')->middleware('auth');

Route::get('/home/mantenimiento/eliminar/{id}', [App\Http\Controllers\mantenimientoController::class, 'deleteMantenimiento'])->name('eliminarMantenimiento')->middleware('auth');

Route::get('/home/mantenimiento/revisado/{id}', [App\Http\Controllers\mantenimientoController::class, 'mantenimientoComplete'])->name('salidaMantenimiento')->middleware('auth');

Route::get('/home/mantenimiento/reparados/', [App\Http\Controllers\mantenimientoController::class, 'mantenimientoReparados'])->name('getListaEquiposReparados')->middleware('auth');


//RUTAS SOLICITUD APROBACIONDE COMPRA
Route::get('/home/aprobacion', [App\Http\Controllers\sapbcompraController::class, 'getAprobacion'])->name('getListaAprobacion')->middleware('auth');

Route::get('/home/aprobacion/search/{id}', [App\Http\Controllers\sapbcompraController::class, 'getDatosAprobacion'])->name('editarAprobacion')->middleware('auth');

Route::put('/home/aprobacion/update/{id}', [App\Http\Controllers\sapbcompraController::class, 'updateAprobacion'])->name('actualizarAprobacion')->middleware('auth');

Route::get('/home/aprobacion/eliminar/{id}', [App\Http\Controllers\sapbcompraController::class, 'deleteAprobacion'])->name('eliminarAprobacion')->middleware('auth');

Route::get('/home/aprobacion/nuevo', [App\Http\Controllers\sapbcompraController::class, 'nuevaAprobacionCompra'])->name('abrirNuevaAprobacion')->middleware('auth');

Route::put('/home/aprobacion/insert/new/{id}', [App\Http\Controllers\sapbcompraController::class, 'insertAprobacion'])->name('agregarAprobacion')->middleware('auth');

Route::get('/home/aprobacion/generar/email/{id}', [App\Http\Controllers\sapbcompraController::class, 'sendEmailAprobacion'])->name('generarCorreoAprobacion')->middleware('auth');

Route::get('/aprobacion/aprobar/{id}', [App\Http\Controllers\sapbcompraController::class, 'aprobarSolicitudapb']);

Route::get('/aprobacion/rechazar/{id}', [App\Http\Controllers\sapbcompraController::class, 'rechazarSolicitudapb']);


//RUTAS SOLICITUD DE COMPRA
Route::get('/home/compras', [App\Http\Controllers\scompraController::class, 'getCompras'])->name('getListaCompras')->middleware('auth');

Route::get('/home/compras/search/{id}', [App\Http\Controllers\scompraController::class, 'getDatosCompra'])->name('editarCompra')->middleware('auth');

Route::put('/home/compras/update/{id}', [App\Http\Controllers\scompraController::class, 'updateDatosCompra'])->name('actualizarCompra')->middleware('auth');

Route::get('/home/compras/eliminar/{id}', [App\Http\Controllers\scompraController::class, 'deleteCompra'])->name('eliminarCompra')->middleware('auth');

Route::get('/home/compras/nuevo', [App\Http\Controllers\scompraController::class, 'nuevaCompra'])->name('abrirNuevaCompra')->middleware('auth');

Route::put('/home/compras/insert/new/{id}', [App\Http\Controllers\scompraController::class, 'insertCompra'])->name('agregarCompra')->middleware('auth');

Route::get('/home/compras/generar/email/{id}', [App\Http\Controllers\scompraController::class, 'sendEmailCompra'])->name('generarCorreoCompra')->middleware('auth');

//RUTAS REPORTES
Route::get('/home/reportes/lista/inventario', [App\Http\Controllers\reportesController::class, 'getInventario'])->name('getListaEquiposReporte')->middleware('auth');

Route::get('/home/reportes/generar/inventario/PDF', [App\Http\Controllers\reportesController::class, 'reporteInventarioPDF'])->name('generarReporteInventarioPDF')->middleware('auth');

Route::get('/home/reportes/generar/inventario/EXCEL', [App\Http\Controllers\reportesController::class, 'reporteInventarioEXCEL'])->name('generarReporteInventarioEXCEL')->middleware('auth');

Route::get('/home/reportes/lista/permisos', [App\Http\Controllers\reportesController::class, 'getPermisos'])->name('getListaPermisosReporte')->middleware('auth');

Route::get('/home/reportes/generar/permisos/PDF', [App\Http\Controllers\reportesController::class, 'reportePermisoPDF'])->name('generarReportePermisoPDF')->middleware('auth');

Route::get('/home/reportes/generar/permisos/EXCEL', [App\Http\Controllers\reportesController::class, 'reportePermisoEXCEL'])->name('generarReportePermisoEXCEL')->middleware('auth');

Route::get('/home/reportes/lista/compras', [App\Http\Controllers\reportesController::class, 'getcompras'])->name('getListacomprasReporte')->middleware('auth');

Route::get('/home/reportes/generar/compras/PDF', [App\Http\Controllers\reportesController::class, 'reportecomprasPDF'])->name('generarReportecomprasPDF')->middleware('auth');

Route::get('/home/reportes/generar/compras/EXCEL', [App\Http\Controllers\reportesController::class, 'reportecomprasEXCEL'])->name('generarReportecomprasEXCEL')->middleware('auth');

Route::get('/home/reportes/generar/reparados/PDF', [App\Http\Controllers\reportesController::class, 'reporteReparadosPDF'])->name('generarReporteReparadosPDF')->middleware('auth');

Route::get('/home/reportes/generar/reparados/EXCEL', [App\Http\Controllers\reportesController::class, 'reporteReparadosEXCEL'])->name('generarReporteReparadosEXCEL')->middleware('auth');

Route::get('/home/reportes/lista/personas', [App\Http\Controllers\reportesController::class, 'getpersonas'])->name('getListaPersonasReporte')->middleware('auth');

Route::get('/home/reportes/generar/personas/PDF', [App\Http\Controllers\reportesController::class, 'reportepersonasPDF'])->name('generarReportepersonasPDF')->middleware('auth');

Route::get('/home/reportes/generar/personas/EXCEL', [App\Http\Controllers\reportesController::class, 'reportepersonasEXCEL'])->name('generarReportepersonasEXCEL')->middleware('auth');


