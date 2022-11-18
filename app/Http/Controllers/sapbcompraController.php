<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class sapbcompraController extends Controller
{
    public function getAprobacion(Request $request){
        $data = Http::post('http://localhost:6000/aprobacion/get', [
            'funcion' => 's',
        ]);
        $datos = $data->json();
        $dataDos = HTTP::post('http://localhost:6000/mantenimiento/get',[
            'funcion' => 'r'
        ]);
        $equipos = $dataDos->json();
        $equipos = $equipos[0];
        return view('sapbcompraLista',compact('datos','equipos'));
    }

    public function nuevaAprobacionCompra(Request $request){
        $dataDos = HTTP::post('http://localhost:6000/mantenimiento/search',[
            'funcion' => 'b',
            'cod_reparacion' => $request->cod_reparacion
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0]; 
        $id = $request->cod_reparacion;      
        return view('sapbcompraNuevo',compact('datos','id'));
    }

    public function insertAprobacion(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'cotizacion' => 'required',
            'fecha_solicitud' => 'required',

        ],[
            'cotizacion.required' => 'Debe ingresar la cotización o precio del equipo requerido.',
            'fecha_solicitud.required' => 'Debe ingresar la fecha de solicitud de aprobación de compra del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        $dataDos = HTTP::post('http://localhost:6000/mantenimiento/search',[
            'funcion' => 'b',
            'cod_reparacion' => $id
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0][0]; 

        HTTP::post('http://localhost:6000/aprobacion/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'cod_equipo' => $datos['COD_EQUIPO'],
            'cod_reparacion' => $datos['COD_REPARACION'],
            'coz_equipo' => $request->cotizacion,
            'fec_solicitud' => $request->fecha_solicitud,
        ]);

        return redirect()->route('getListaAprobacion')->with('mensaje','Agregado exitosamente');
    }

    public function deleteAprobacion(Request $request,$id){
        Http::post('http://localhost:6000/aprobacion/delete', [
            'funcion' => 'd',
            'cod_sol_apb_compra' => $id,
        ]);

        return redirect()->route('getListaAprobacion')->with('mensaje','Eliminado exitosamente');
    }

    public function getDatosAprobacion(Request $request, $id){
        $datos = HTTP::post('http://localhost:6000/aprobacion/search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $id,
        ]);
        $datos = $datos->json();
        $datos = $datos[0];
        return view(' sapbcompraEditar',compact('datos'));
    }

    public function updateAprobacion(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'cotizacion' => 'required',
            'fecha_solicitud' => 'required',

        ],[
            'cotizacion.required' => 'Debe ingresar el precio o cotizacion del equipo requerido.',
            'fecha_solicitud.required' => 'Debe ingresar la fecha de solicitud de aprobación de compra del equipo.',
            
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/aprobacion/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_apb_compra' => $id,
            'coz_equipo' => $request->cotizacion,
            'fec_solicitud' => $request->fecha_solicitud,
        ]);
        return redirect()->route('getListaAprobacion')->with('mensaje','Actualizado exitosamente');
    }
}
