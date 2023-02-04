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
        $data = HTTP::post('http://localhost:6000/persona/search',[
            'funcion' => 'b',
            'cod_persona' => $observacion[0]['COD_PERSONA'],
        ]);
        $persona = $data->json();
        $persona = $persona[0];
        return view('bitacoraEditar',compact('observacion','persona'));
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
             //Validar campos nulos
             $validator = Validator::make($request->all(), [
                'descripcion' => 'required',
                'fecha_observacion' => 'required',
            ],[
                'descripcion.required' => 'Debe ingresar la descripcion de la observacion.',
                'fecha_observacion.required' => 'Debe ingresar la fecha de la observacion.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);        
            }
    
            //Validar caracteres especiales
            $validator = Validator::make($request->all(), [
                'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
                'fecha_observacion' => 'required|date|after:2000-01-01',
            ],[
                'descripcion.regex' => 'Descripcion de la observacion solo debe contener letras y numeros.',
                'fecha_observacion.after' => 'Ingrese una fecha valida.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);        
            }
    
            //Validar cantidad caracteres
            $validator = Validator::make($request->all(), [
                'descripcion' => 'max:1499',
                'fecha_observacion' => 'before:01/01/2050',
            ],[
                'descripcion.max' => 'Descripcion de la observacion contiene demasiados caracteres.',
                'fecha_observacion.before' => 'Ingrese una fecha valida.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);        
            }
    
            $pieces = explode("-", $request->fecha_observacion);
            if (strlen($pieces[0])>4) {
                return back()->withInput()
                            ->with('error','Ingrese una fecha valida');
                            
            }

        HTTP::post('http://localhost:6000/bitacora/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_bit_mejora' => $id,
            'des_observacion' => $request->descripcion,
            'fec_observacion' => $request->fecha_observacion,
        ]);
        return redirect()->route('getListaObservacion')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertObservacion(Request $request){
    if(Auth::user()->hasPermission('bitacora-agregar')){
        //Validar campos nulos
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
            'fecha_observacion' => 'required',
            'cod_persona' => 'required',
        ],[
            'descripcion.required' => 'Debe ingresar la descripcion de la observacion.',
            'fecha_observacion.required' => 'Debe ingresar la fecha de la observacion.',
            'cod_persona.required' => 'Debe ingresar el nombre del evaluador.',        
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);        
        }

        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
            'fecha_observacion' => 'required|date|after:2000-01-01',
        ],[
            'descripcion.regex' => 'Descripcion de la observacion solo debe contener letras y numeros.',
            'fecha_observacion.after' => 'Ingrese una fecha valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);        
        }

        //Validar cantidad caracteres
        $validator = Validator::make($request->all(), [
            'descripcion' => 'max:1499',
            'fecha_observacion' => 'before:01/01/2050',
        ],[
            'descripcion.max' => 'Descripcion de la observacion contiene demasiados caracteres.',
            'fecha_observacion.before' => 'Ingrese una fecha valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);        
        }

        if ($request->cod_persona==null) {
            return back()->withInput()
                        ->with('error','Debe seleccionar un evaluador');        
        }

        
        $pieces = explode("-", $request->fecha_observacion);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha valida');
                        
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
