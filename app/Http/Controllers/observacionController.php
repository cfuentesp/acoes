<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class observacionController extends Controller
{
    public function getObservacion(Request $request){
        $data = Http::post('http://localhost:6000/bitacora/get', [
            'funcion' => 's',
        ]);
        $observaciones = $data->json();
        return view('bitacoraLista',compact('observaciones'));
    }

    public function getDatosObservacion(Request $request, $id){
        $datos = HTTP::post('http://localhost:6000/bitacora/search',[
            'funcion' => 'b',
            'cod_bit_mejora' => $id,
        ]);
        $observacion = $datos->json();
        $observacion = $observacion[0];
        return view('bitacoraEditar',compact('observacion'));
    }

    public function nuevoBitacora(Request $request){
        $data = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $data->json();
        $personas = $personas[0];
        return view('bitacoraNuevo',compact('personas'));
    }

    public function deleteObservacion(Request $request,$id){
        $inventario = Http::post('http://localhost:6000/bitacora/delete', [
            'funcion' => 'd',
            'cod_bit_mejora' => $id,
        ]);

        $inventario = Http::post('http://localhost:6000/bitacora/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventarioLista',compact('equipos'));

    }

    public function updateDatosObservacion(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'cod_persona' => 'required',
            'des_observacion' => 'required',
            'fec_observacion' => 'required',

        ],[
            'cod_persona.required' => 'Debe ingresar el nombre del evaluador.',
            'des_observacion.required' => 'Debe ingresar la descripcion de la observacion.',
            'fec_observacion.required' => 'Debe ingresar la fecha de la observacion.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);        
        }

        HTTP::post('http://localhost:6000/bitacora/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_bit_mejora' => $id,
            'cod_persona' => $request->cod_persona,
            'dec_observacion' => $request->des_observacion,
            'fec_observacion' => $request->fec_observacion,
        ]);
        $data = Http::post('http://localhost:6000/bitacora/get', [
            'funcion' => 's',
        ]);
        $observaciones = $data->json();
        return back()->with('mensaje','Actualizacion exitosa.');
    }

    public function insertObservacion(Request $request){
        $validator = Validator::make($request->all(), [
            'cod_persona' => 'required',
            'descripcion' => 'required',
            'fecha_observacion' => 'required',

        ],[
            'cod_persona.required' => 'Debe ingresar el nombre del evaluador.',
            'descripcion.required' => 'Debe ingresar la descripcion de la observacion.',
            'fecha_observacion.required' => 'Debe ingresar la fecha de la observacion.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);        
        }

        HTTP::post('http://localhost:6000/bitacora/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'cod_persona' => $request->cod_persona,
            'des_observacion' => $request->descripcion,
            'fec_observacion' => $request->fecha_observacion,
        ]);

        $data = Http::post('http://localhost:6000/bitacora/get', [
            'funcion' => 's',
        ]);
        $observaciones = $data->json();
        return view('bitacoraLista',compact('observaciones'));
    }
}
