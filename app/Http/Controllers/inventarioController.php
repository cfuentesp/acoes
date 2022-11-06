<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\Validator;

class inventarioController extends Controller
{
    public function getInventario(Request $request){
        if(Auth::user()->hasPermission('inventario')){
        $data = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $data->json();
        return view('inventarioLista',compact('equipos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoEquipo(Request $request){
        if(Auth::user()->hasPermission('inventario-agregar')){
        return view('inventarioNuevo');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertEquipo(Request $request){
        if(Auth::user()->hasPermission('inventario-agregar')){
        $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'required',
            'marca_equipo' => 'required',
            'modelo_serie' => 'required',
            'especificaciones' => 'required',
            'color_equipo' => 'required',
            'numero_equipo' => 'required',
            'fecha_ingreso' => 'required',
        ],[
            'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
            'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
            'modelo_Serie.required' => 'Debe ingresar el modelo/serie del equipo.',
            'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'color_equipo.required' => 'Debe ingresar el color del equipo.',
            'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        HTTP::post('http://localhost:6000/inventario/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);

        return redirect()->route('getListaEquipos')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteEquipo(Request $request,$id){
        if(Auth::user()->hasPermission('inventario-eliminar')){
        Http::post('http://localhost:6000/inventario/delete', [
            'funcion' => 'd',
            'cod_equipo' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosEquipo(Request $request, $id){
        if(Auth::user()->hasPermission('inventario-eliminar')){
        $datos = HTTP::post('http://localhost:6000/inventario/search',[
            'funcion' => 'b',
            'cod_equipo' => $id,
        ]);
        $equipo = $datos->json();
        $equipo = $equipo[0];
        $equipo[0]['FEC_INGRESO']=date("Y-m-d", strtotime($equipo[0]['FEC_INGRESO']));
        return view('inventarioEditar',compact('equipo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosEquipo(Request $request, $id){
        if(Auth::user()->hasPermission('inventario-editar')){
        $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'required',
            'marca_equipo' => 'required',
            'modelo_serie' => 'required',
            'especificaciones' => 'required',
            'color_equipo' => 'required',
            'numero_equipo' => 'required',
            'fecha_ingreso' => 'required',

        ],[
            'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
            'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
            'modelo_Serie.required' => 'Debe ingresar el modelo/serie del equipo.',
            'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'color_equipo.required' => 'Debe ingresar el color del equipo.',
            'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }
        HTTP::post('http://localhost:6000/inventario/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_equipo' => $id,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);
        return redirect()->route('getListaEquipos')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
