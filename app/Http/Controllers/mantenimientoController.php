<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class mantenimientoController extends Controller
{
    public function getMantenimiento(Request $request){
        if(Auth::user()->hasPermission('mantenimiento')){
        $data = HTTP::post('http://localhost:6000/mantenimiento/get',[
            'funcion' => 's'
        ]);
        $datos = $data->json();
        $datos = $datos[0];
        return view('mantenimientoLista',compact('datos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosMantenimiento(Request $request,$id){
        if(Auth::user()->hasPermission('mantenimiento-editar')){
        $data = HTTP::post('http://localhost:6000/mantenimiento/search',[
            'funcion' => 'b',
            'cod_reparacion' => $id,
        ]);
        $datos = $data->json();
        $datos = $datos[0];
        $id = $id;
        return view('mantenimientoEditar',compact('datos','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateMantenimiento(Request $request,$id){
        if(Auth::user()->hasPermission('mantenimiento-editar')){
        $validator = Validator::make($request->all(), [
            'descripcion_falla' => 'required',
            'solucion_problema' => 'required',
        ],[
            'descripcion_falla.required' => 'Debe ingresar el tipo de equipo.',
            'solucion_problema.required' => 'Debe ingresar la solucion.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);               
        }

        HTTP::post('http://localhost:6000/mantenimiento/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_reparacion' => $id,
            'des_falla' => $request->descripcion_falla,
            'sol_problema' => $request->solucion_problema,
        ]);
        
        return redirect()->route('getListaMantenimiento')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    } 

    public function deleteMantenimiento(Request $request,$id){
        if(Auth::user()->hasPermission('mantenimiento-eliminar')){
        Http::post('http://localhost:6000/mantenimiento/delete', [
            'funcion' => 'd',
            'cod_reparacion' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}