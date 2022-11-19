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
    if(Auth::user()->hasPermission('compras')){
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
    return back()->with('error','No tienes permisos');
    }

    public function nuevaCompra(Request $request){
    if(Auth::user()->hasPermission('compras-agregar')){
        $dataDos = HTTP::post('http://localhost:6000/aprobacion/search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $request->cod_solicitud
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0]; 
        $id = $request->cod_solicitud; 
        return view('scompraNuevo', compact('datos','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertCompra(Request $request, $id){
    if(Auth::user()->hasPermission('compras-agregar')){
        $validator = Validator::make($request->all(), [
            'fecha_solicitud' => 'required',
            'descripcion' => 'required',
        ],[
            'fecha_solicitud.required' => 'Debe ingresar la fecha de la solicitud de compra.',
            'descripcion.required' => 'Debe ingresar la descripción de la solicitud de compra.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        $dataDos = HTTP::post('http://localhost:6000/aprobacion/search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $id
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0][0];  

        HTTP::post('http://localhost:6000/compra/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_apb_compra' => $datos['COD_SOL_APB_COMPRA'],
            'cod_reparacion' => $datos['COD_REPARACION'],
            'fec_solicitud' => $request->fecha_solicitud,
            'des_solicitud' => $request->descripcion,
        ]);

        return redirect()->route('getListaCompras')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteCompra(Request $request,$id){
    if(Auth::user()->hasPermission('compras-eliminar')){
        Http::post('http://localhost:6000/compra/delete', [
            'funcion' => 'd',
            'cod_sol_compra' => $id,
        ]);

        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosCompra(Request $request, $id){
    if(Auth::user()->hasPermission('compras-editar')){
        $data = HTTP::post('http://localhost:6000/compra/search',[
            'funcion' => 'b',
            'cod_sol_compra' => $id,
        ]);
        $datos = $data->json();
        $datos = $datos[0];
        return view('scompraEditar',compact('datos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosCompra(Request $request, $id){
    if(Auth::user()->hasPermission('compras-editar')){
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
            'fecha_solicitud' => 'required'
        ],[
            'descripcion.required' => 'Debe ingresar la descripcion',
            'fecha_solicitud.required' => 'Debe ingresar la fecha de la solicitud',
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
            'fec_solicitud' => $request->fecha_solicitud
        ]);

        return redirect()->route('getListaCompras')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
