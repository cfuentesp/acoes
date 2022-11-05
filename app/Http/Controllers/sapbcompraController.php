<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class sapbcompraController extends Controller
{
    public function getSolicitudApbCompra(Request $request){
        $SolicitudApbCompra = Http::post('http://localhost:3004/SolicitudApbCompra/get', [
            'funcion' => 's',
        ]);
        $AprobacionCo = $SolicitudApbCompra->json();
        return view('SolicitudApbCompra',compact('AprobacionCo'));
    }

    public function nuevaAprovacionC(Request $request){
        $header = "Agregar nueva Aprobación de Compra";
        return view('SolicitudApbCompraNuevo',compact('header'));
    }

    public function insertAprobacionC(Request $request){
        $validator = Validator::make($request->all(), [
            'coz_equipo' => 'required',
            'fec_solicitud' => 'required',
            'ind_solicitud' => 'required',

        ],[
            'coz_equipo.required' => 'Debe ingresar la cotización o precio del equipo requerido.',
            'fec_solicitud.required' => 'Debe ingresar la fecha de solicitud de aprobación de compra del equipo.',
            'ind_solicitud.required' => 'Debe ingresar el estado de solicitud de aprobación de compra del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/inventario/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'coz_equipo' => $request->cotizacion_equipo,
            'fec_solicitud' => $request->fecha_solicitud,
            'ind_solicitud' => $request->estado_solicitud
        ]);

        $SolicitudApbCompra = Http::post('http://localhost:3004/inventario/get', [
            'funcion' => 's',
        ]);
        $AprobacionCo = $SolicitudApbCompra->json();
        return view('SolicitudApbCompra',compact('AprobacionCo'));

    }

    public function deleteAprobacionC(Request $request,$id){
        $SolicitudApbCompra = Http::post('http://localhost:6000/SolicitudApbCompra/delete', [
            'funcion' => 'd',
            'cod_sol_apb_compra' => $id,
        ]);

        $inventario = Http::post('http://localhost:3004/ SolicitudApbCompra /get', [
            'funcion' => 's',
        ]);
        $AprobacionCo = $SolicitudApbCompra->json();
        return view('SolicitudApbCompra',compact('AprobacionCo'));

    }

    public function getDatosAprobacionC(Request $request, $id){
        $datos = HTTP::post('http://localhost:3004/ SolicitudApbCompra /search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $id,
        ]);
        $AprobacionC = $datos->json();
        $AprobacionC = $AprobacionC[0];
        return view(' SolicitudApbCompraEditar',compact('AprobacionC'));
    }

    public function updateDatosAprobacionC(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'coz_equipo' => 'required',
            'fec_solicitud' => 'required',
            'ind_solicitud' => 'required',

        ],[
            'coz_equipo.required' => 'Debe ingresar el precio o cotizacion del equipo requerido.',
            'fec_solicitud.required' => 'Debe ingresar la fecha de solicitud de aprobación de compra del equipo.',
            'ind_solicitud.required' => 'Debe ingresar el estado de solicitud de aprobación de compra del equipo',
            
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:3004/SolicitudApbCompra/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_apb_compra' => $id,
            'coz_equipo' => $request->cotizacion_equipo,
            'fec_solicitud' => $request->fecha_solicitud,
            'ind_solicitud' => $request->estado_solicitud,
        ]);
        $SolicitudApbCompra = Http::post('http://localhost:3004/SolicitudApbCompra/get', [
            'funcion' => 's',
        ]);
        $AprobacionC = $SolicitudApbCompra->json();
        return view('SolicitudApbCompra',compact('AprobacionC'));
    }
}
