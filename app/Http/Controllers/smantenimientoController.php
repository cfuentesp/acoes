<?php

namespace App\Http\Controllers;

use App\Mail\compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class smantenimientoController extends Controller
{
    public function getItems(Request $request){
        $data = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $data->json();
        $equipos = $equipos[0];
        return view('solicitudMantenimiento',compact('equipos'));
    }

    public function insertMantenimiento(Request $request){
        //Validar campos vacios
        $validator = Validator::make($request->all(), [
            'tip_solicitud' => 'required',
            'area' => 'required',
            'motivo' => 'required',
            'cod_equipo' => 'required',
        ],[
            'tip_solicitud.required' => 'Debe ingresar el tipo de solicitud.',
            'area.required' => 'Debe ingresar el area de la solicitud.',
            'motivo.required' => 'Debe ingresar el motivo de la solicitud.',
            'cod_equipo.required' => 'Debe ingresar el numero de equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        //Validar caraceres especiales
        $validator = Validator::make($request->all(), [
            'tip_solicitud' => 'regex:/^[a-zA-Z\s]+$/u',
            'area' => 'regex:/^[a-zA-Z\s]+$/u',
            'motivo' => 'regex:/^[a-zA-Z\s]+$/u',
            'cod_equipo' => 'alpha_num',
        ],[
            'tip_solicitud.regex' => 'Tipo de solicitud solo debe contener letras.',
            'area.regex' => 'Area de solicitud solo debe contener letras.',
            'motivo.regex' => 'Motivo de la solicitud solo debe contener letras.',
            'cod_equipo.alpha_num' => 'Numero de equipo invalido.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        //Validar cantidad de cracteres
        $validator = Validator::make($request->all(), [
            'tip_solicitud' => 'max:60',
            'area' => 'max:60',
            'motivo' => 'max:1499',
        ],[
            'tip_solicitud.max' => 'Tipo de solicitud contiene demasiados caracteres.',
            'area.max' => 'Area de solicitud contiene demasiados caracteres',
            'motivo.max' => 'Motivo de la solicitud contiene demasiados caracteres',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        $data = HTTP::post('http://localhost:6000/solicitud/result',[
            'funcion' => 'r',
            'cod_equipo' => $request->cod_equipo,
        ]);
        $dato = $data->json();
        
        if($dato[0][0]['existe']>0){
            return back()->with('error','El equipo seleccionado ya se encuentra en mantenimmiento');
        }
        

        HTTP::post('http://localhost:6000/solicitud/insert',[
            'cod_equipo' => $request->cod_equipo,
            'motivo' => $request->motivo,
            'tipo' => $request->tip_solicitud,
            'area' => $request->area,
        ]);
        return redirect()->route('getListaSolicitud')->with('mensaje','Solicitud realizada con exito');
    }

    ////////////////////////////
    public function getSolicitud(Request $request){
    if(Auth::user()->hasPermission('solicitud')){
        $data = Http::post('http://localhost:6000/solicitud/get', [
            'funcion' => 's',
        ]);
        $solicitudes = $data->json();
        return view('smantenimientoLista',compact('solicitudes'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosSolicitud(Request $request, $id){
    if(Auth::user()->hasPermission('solicitud-editar')){
        $data = HTTP::post('http://localhost:6000/solicitud/search',[
            'funcion' => 'b',
            'cod_sol_mantenimiento' => $id,
        ]);
        $datos = $data->json();
        $datos = $datos[0];
        $datos[0]['FEC_SOLICITUD']=date("Y-m-d", strtotime($datos[0]['FEC_SOLICITUD']));
        return view('smantenimientoEditar',compact('datos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteSolicitud(Request $request,$id){
    if(Auth::user()->hasPermission('solicitud-eliminar')){
        Http::post('http://localhost:6000/solicitud/delete', [
            'funcion' => 'd',
            'cod_sol_mantenimiento' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}