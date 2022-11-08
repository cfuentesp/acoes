<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class spermisoController extends Controller
{
    public function getPermisos(Request $request){
    if(Auth::user()->hasPermission('permisos')){
        $data = Http::post('http://localhost:6000/permiso/get', [
            'funcion' => 's',
        ]);
        $permisos = $data->json();
        $permisos = $permisos[0];
        return view('spermisoLista',compact('permisos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoPermiso(Request $request){
    if(Auth::user()->hasPermission('permisos-agregar')){
        return view('spermisoNuevo');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertPermiso(Request $request){
    if(Auth::user()->hasPermission('permisos-agregar')){
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'required',
            'descripcion' => 'required',
            'fecha_solicitud' => 'required',
            'inicio_permiso' => 'required',
            'final_permiso' => 'required',
        ],[
            'tipo_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'descripcion.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'fecha_solicitud.required' => 'Debe ingresar la fecha en que solicito el permiso.',
            'inicio_permiso.required' => 'Debe ingresar la fecha en que inicia el permiso.',
            'final_permiso.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        HTTP::post('http://localhost:6000/permiso/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'cod_persona' => 1,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion,
            'fec_solicitud' => $request->fecha_solicitud,
            'fec_inicio' => $request->inicio_permiso,
            'fec_final' => $request->final_permiso,
        ]);
        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deletePermiso(Request $request,$id){
    if(Auth::user()->hasPermission('permisos-eliminar')){
        Http::post('http://localhost:6000/permiso/delete', [
            'funcion' => 'd',
            'cod_sol_permiso' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosPermiso(Request $request, $id){
    if(Auth::user()->hasPermission('permisos-editar')){
        $data = HTTP::post('http://localhost:6000/permiso/search',[
            'funcion' => 'b',
            'cod_sol_permiso' => $id,
        ]);
        $permiso = $data->json();
        $permiso = $permiso[0];
        $permiso[0]['FEC_SOLICITUD']=date("Y-m-d", strtotime($permiso[0]['FEC_SOLICITUD']));
        $permiso[0]['FEC_INICIO']=date("Y-m-d", strtotime($permiso[0]['FEC_INICIO']));
        $permiso[0]['FEC_FINAL']=date("Y-m-d", strtotime($permiso[0]['FEC_FINAL']));
        return view('spermisoEditar',compact('permiso'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosPermiso(Request $request, $id){
    if(Auth::user()->hasPermission('permisos-editar')){
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'required',
            'descripcion' => 'required',
            'fecha_solicitud' => 'required',
            'inicio_solicitud' => 'required',
            'final_solicitud' => 'required',
        ],[
            'tipo_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'descripcion.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'fecha_solicitud.required' => 'Debe ingresar la fecha en que solicito el permiso.',
            'inicio_solicitud.required' => 'Debe ingresar la fecha en que inicio el permiso.',
            'final_solicitud.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/permiso/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_permiso' => $id,
            'cod_persona' => 1,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion,
            'fec_inicio' => $request->inicio_solicitud,
            'fec_final' => $request->final_solicitud,
            'ind_solicitud' => $request->estado_solicitud,
            'jst_solicitud' => $request->justificacion_solicitud
        ]);
        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
