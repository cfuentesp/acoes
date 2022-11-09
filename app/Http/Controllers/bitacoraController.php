<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class bitacoraController extends Controller
{
    public function getObservacion(Request $request){
    if(Auth::user()->hasPermission('bitacora')){
        $data = Http::post('http://localhost:6000/bitacora/get', [
            'funcion' => 's',
        ]);
        $observaciones = $data->json();
        $observaciones[0][0]['FEC_OBSERVACION']=date("Y-m-d", strtotime($observaciones[0][0]['FEC_OBSERVACION']));
        
        $observaciones = $data->json();
        return view('bitacoraLista',compact('observaciones'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosObservacion(Request $request, $id){
    if(Auth::user()->hasPermission('bitacora-editar')){
        $datos = HTTP::post('http://localhost:6000/bitacora/search',[
            'funcion' => 'b',
            'cod_bit_mejora' => $id,
        ]);
        $observacion = $datos->json();
        $observacion = $observacion[0];
        $observacion[0]['FEC_OBSERVACION']=date("Y-m-d", strtotime($observacion[0]['FEC_OBSERVACION']));
        $data = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $data->json();
        $personas = $personas[0];
        return view('bitacoraEditar',compact('observacion','personas'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoBitacora(Request $request){
    if(Auth::user()->hasPermission('bitacora-agregar')){
        $data = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $data->json();
        $personas = $personas[0];
        return view('bitacoraNuevo',compact('personas'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteObservacion(Request $request,$id){
    if(Auth::user()->hasPermission('bitacora-eliminar')){
        Http::post('http://localhost:6000/bitacora/delete', [
            'funcion' => 'd',
            'cod_bit_mejora' => $id,
        ]);
        return redirect()->route('getListaObservacion')->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosObservacion(Request $request, $id){
        if(Auth::user()->hasPermission('bitacora-editar')){
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
        HTTP::post('http://localhost:6000/bitacora/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_bit_mejora' => $id,
            'cod_persona' => $request->cod_persona,
            'des_observacion' => $request->descripcion,
            'fec_observacion' => $request->fecha_observacion,
        ]);
        return redirect()->route('getListaObservacion')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertObservacion(Request $request){
    if(Auth::user()->hasPermission('bitacora-agregar')){
        dd($request->all());
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
       return redirect()->route('getListaObservacion')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
