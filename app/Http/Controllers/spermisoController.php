<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class spermisoController extends Controller
{
    public function getSolicitudPermiso(Request $request){
        $SolicitudPermiso = Http::post('http://localhost:3004/SolicitudPermiso/get', [
            'funcion' => 's',
        ]);
        $Permisos = $SolicitudPermiso->json();
        return view('SolicitudPermiso',compact('Permisos'));
    }

    public function nuevoPermiso(Request $request){
        $header = "Agregar nueva Solicitud de Permiso";
        return view('SolicitudPermisoNuevo',compact('header'));
    }

    public function insertPermiso(Request $request){
        $validator = Validator::make($request->all(), [
            'tip_solicitud' => 'required',
            'des_solicitud' => 'required',
            'fec_solicitud' => 'required',
            'fec_inicio' => 'required',
            'fec_final' => 'required',
            'ind_final' => 'required',
            'jst_solicitud' => 'required',

        ],[
            'tip_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'des_solicitud.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'fec_solicitud.required' => 'Debe ingresar la fecha en que solicito el permiso.',
            'fec_inicio.required' => 'Debe ingresar la fecha en que inicio el permiso.',
            'fec_final.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
            'ind_final.required' => 'Debe ingresar el estado de la solicitud de permiso',
            'jst_solicitud.required' => 'Debe ingresar la justificación del permiso',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/SolicitudPermiso/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion_solicitud,
            'fec_solicitud' => $request->fecha_solicitud,
            'fec_inicio' => $request->inicio_solicitud,
            'fec_final' => $request->final_solicitud,
            'ind_solicitud' => $request->estado_solicitud,
            'jst_solicitud' => $request->justificación_solicitud
        ]);

        $SolicitudPermiso = Http::post('http://localhost:3004/SolicitudPermiso/get', [
            'funcion' => 's',
        ]);
        $Permisos = $SolicitudPermiso->json();
        return view('SolicitudPermiso',compact('Permisos'));

    }

    public function deletePermiso(Request $request,$id){
        $SolicitudPermiso = Http::post('http://localhost:6000/SolicitudPermiso/delete', [
            'funcion' => 'd',
            'cod_sol_permiso' => $id,
        ]);

        $SolicitudPermiso = Http::post('http://localhost:3004/SolicitudPermiso/get', [
            'funcion' => 's',
        ]);
        $Perimisos = $SolicitudPermiso->json();
        return view('SolicitudPermiso',compact('Permisos'));

    }

    public function getDatosEquipo(Request $request, $id){
        $datos = HTTP::post('http://localhost:3004/SolicitudPermiso/search',[
            'funcion' => 'b',
            'cod_sol_permiso' => $id,
        ]);
        $Permiso = $datos->json();
        $Permiso = $Permiso[0];
        return view('SolicitudPermisoEditar',compact('Permiso'));
    }

    public function updateDatosPermiso(Request $request, $id){
        $validator = Validator::make($request->all(), [
           'tip_solicitud' => 'required',
            'des_solicitud' => 'required',
            'fec_solicitud' => 'required',
            'fec_inicio' => 'required',
            'fec_final' => 'required',
            'ind_final' => 'required',
            'jst_solicitud' => 'required',

        ],[
            'tip_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'des_solicitud.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'fec_solicitud.required' => 'Debe ingresar la fecha en que solicito el permiso.',
            'fec_inicio.required' => 'Debe ingresar la fecha en que inicio el permiso.',
            'fec_final.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
            'ind_final.required' => 'Debe ingresar el estado de la solicitud de permiso',
            'jst_solicitud.required' => 'Debe ingresar la justificación del permiso',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:3004/SolicitudPermiso/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_permiso' => $id,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion_solicitud,
            'fec_solicitud' => $request->fecha_solicitud,
            'fec_inicio' => $request->inicio_solicitud,
            'fec_final' => $request->final_solicitud,
            'ind_solicitud' => $request->estado_solicitud,
            'jst_solicitud' => $request->justificación_solicitud
        ]);
        $SolicitudPermiso = Http::post('http://localhost:3004/SolicitudPermiso/get', [
            'funcion' => 's',
        ]);
        $Permiso = $SolicitudPermiso->json();
        return view('SolicitudPermiso',compact('Permisos'));
    }
}
