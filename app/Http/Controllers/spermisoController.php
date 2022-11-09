<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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
        $data = Http::post('http://localhost:6000/persona/get', [
            'funcion' => 's',
        ]);
        $personas = $data->json();
        $personas = $personas[0];
        return view('spermisoNuevo',compact('personas'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertPermiso(Request $request){
    if(Auth::user()->hasPermission('permisos-agregar')){
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'required',
            'descripcion' => 'required',
            'inicio_permiso' => 'required',
            'final_permiso' => 'required',
        ],[
            'tipo_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'descripcion.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
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
            'cod_persona' => $request->cod_persona,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion,
            'fec_solicitud' => date("Y-m-d"),
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
        $permiso[0]['FEC_INICIO']=date("Y-m-d", strtotime($permiso[0]['FEC_INICIO']));
        $permiso[0]['FEC_FINAL']=date("Y-m-d", strtotime($permiso[0]['FEC_FINAL']));

        $dataDos = HTTP::post('http://localhost:6000/persona/search',[
            'funcion' => 'b',
            'cod_persona' => $permiso[0]['COD_PERSONA'],
        ]);
        $persona = $dataDos->json();
        $persona = $persona[0];
        return view('spermisoEditar',compact('permiso','persona'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosPermiso(Request $request, $id){
    if(Auth::user()->hasPermission('permisos-editar')){
        $validator = Validator::make($request->all(), [
            'justificacion' => 'required',
            'estado' => 'required',
        ],[
            'justificacion.required' => 'Debe ingresar la justificacion.',
            'estado.required' => 'Debe ingresar el estado.',
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
            'ind_solicitud' => $request->estado,
            'jst_solicitud' => $request->justificacion
        ]);
        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
