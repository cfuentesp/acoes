<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class scompraController extends Controller
{
    public function getSolicitudCompra (Request $request){
        $SolicitudCompra = Http::post('http://localhost:3004/inventario/get', [
            'funcion' => 's',
        ]);
        $Compras = $SolicitudCompra->json();
        return view('SolicitudCompra',compact('Compras'));
    }

    public function nuevaCompra(Request $request){
        $header = "Agregar nueva Compra";
        return view('CompraNueva',compact('header'));
    }

    public function insertCompra(Request $request){
        $validator = Validator::make($request->all(), [
            'fec_solicitud' => 'required',
            'des_solicitud' => 'required',
            'ind_solicitud' => 'required',
        ],[
            'fec_solicitud.required' => 'Debe ingresar la fecha de la solicitud de compra.',
            'desc_solicitud.required' => 'Debe ingresar la descripción de la solicitud de compra.',
            'ind_solicitud.required' => 'Debe ingresar el estado de la solicitud de compra.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/inventario/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'fec_solicitud' => $request->fecha_solicitud,
            'des_solicitud' => $request->descripcion_solicitud,
            'ind_solicitud' => $request->estado_solicitud,
        ]);

        $SolicitudCompra = Http::post('http://localhost:3004/inventario/get', [
            'funcion' => 's',
        ]);
        $Compras = $SolicitudCompra->json();
        return view('SolicitudCompra',compact('Compras'));

    }

    public function deleteCompra(Request $request,$id){
        $SolicitudCompra = Http::post('http://localhost:6000/SolicitudCompra/delete', [
            'funcion' => 'd',
            'cod_sol_compra' => $id,
        ]);

        $SolicitudCompra = Http::post('http://localhost:3004/SolicitudCompra/get', [
            'funcion' => 's',
        ]);
        $Compras = $SolicitudCompra->json();
        return view('SolicitudCompra',compact('Compras'));

    }

    public function getDatosCompra(Request $request, $id){
        $datos = HTTP::post('http://localhost:3004/SolicitudCompra/search',[
            'funcion' => 'b',
            'cod_sol_compra' => $id,
        ]);
        $Compra = $datos->json();
        $Compra = $Compra[0];
        return view('CompraEditar',compact('Compra'));
    }

    public function updateDatosCompra(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'fec_solicitud' => 'required',
            'desc_solicitud' => 'required',
        ],[
            'fec_solicitud.required' => 'Debe ingresar la fecha de solicitud de compra',
            'desc_solicitud.required' => 'Debe ingresar la descripción de la solicitud de compra',
            'ind_solicitud.required' => 'Debe ingresar el estado de la solicitud de compra',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:3004/SolicitudCompra/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_compra' => $id,
            'fec_solicitud' => $request->fecha_solicitud,
            'des_solicitud' => $request->descripcion_solicitud,
            'ind_solicitud' => $request->estado_solicitud
        ]);
        $SolicitudCompra = Http::post('http://localhost:3004/SolicitudCompra/get', [
            'funcion' => 's',
        ]);
        $Compras = $SolicitudCompra->json();
        return view('SolicitudCompra',compact('Compras'));
    }
}
