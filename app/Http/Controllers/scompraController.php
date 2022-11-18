<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class scompraController extends Controller
{
    public function getCompras (Request $request){
        $data = Http::post('http://localhost:6000/compra/get', [
            'funcion' => 's',
        ]);
        $compras = $data->json();
        $dataDos = Http::post('http://localhost:6000/aprobacion/get', [
            'funcion' => 'a',
        ]);
        $solicitudes = $dataDos->json();
        $solicitudes = $solicitudes[0];
        return view('scompraLista',compact('compras','solicitudes'));
    }

    public function nuevaCompra(Request $request){
        $dataDos = HTTP::post('http://localhost:6000/aprobacion/search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $request->cod_solicitud
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0]; 
        $id = $request->cod_solicitud; 
        return view('scompraNuevo', compact('datos','id'));
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
        $datos = HTTP::post('http://localhost:6000/compra/search',[
            'funcion' => 'b',
            'cod_sol_compra' => $id,
        ]);
        $compra = $datos->json();
        $compra = $compra[0];
        $compra[0]['FEC_INGRESO']=date("Y-m-d", strtotime($compra[0]['FEC_INGRESO']));
        return view('scompraEditar',compact('compra'));
    }

    public function updateDatosCompra(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
        ],[
            'descripcion.required' => 'Debe ingresar la descripcion',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/compra/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_compra' => $id,
            'des_solicitud' => $request->descripcion,
        ]);
        $SolicitudCompra = Http::post('http://localhost:3004/SolicitudCompra/get', [
            'funcion' => 's',
        ]);
        $Compras = $SolicitudCompra->json();
        return view('SolicitudCompra',compact('Compras'));
    }
}
