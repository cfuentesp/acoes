<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscriber;
use App\Mail\Subscribe;


class sapbcompraController extends Controller
{
    public function getAprobacion(Request $request){
    if(Auth::user()->hasPermission('aprobacion')){
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
    return back()->with('error','No tienes permisos');
    }

    public function nuevaAprobacionCompra(Request $request){
    if(Auth::user()->hasPermission('aprobacion-agregar')){
        $dataDos = HTTP::post('http://localhost:6000/mantenimiento/search',[
            'funcion' => 'b',
            'cod_reparacion' => $request->cod_reparacion
        ]);
        $datos = $dataDos->json();
        $datos = $datos[0]; 
        $id = $request->cod_reparacion;      
        return view('sapbcompraNuevo',compact('datos','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertAprobacion(Request $request,$id){
    if(Auth::user()->hasPermission('aprobacion-agregar')){
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
    return back()->with('error','No tienes permisos');
    }

    public function deleteAprobacion(Request $request,$id){
    if(Auth::user()->hasPermission('aprobacion-eliminar')){
        Http::post('http://localhost:6000/aprobacion/delete', [
            'funcion' => 'd',
            'cod_sol_apb_compra' => $id,
        ]);

        return redirect()->route('getListaAprobacion')->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosAprobacion(Request $request, $id){
    if(Auth::user()->hasPermission('aprobacion-editar')){
        $datos = HTTP::post('http://localhost:6000/aprobacion/search',[
            'funcion' => 'b',
            'cod_sol_apb_compra' => $id,
        ]);
        $datos = $datos->json();
        $datos = $datos[0];

        $data = HTTP::post('http://localhost:6000/correos/search',[
            'funcion' => 'b',
            'cod_correo' => 2
        ]);
        $correo = $data->json();
        $correo = $correo[0];

        return view(' sapbcompraEditar',compact('datos','correo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateAprobacion(Request $request, $id){
    if(Auth::user()->hasPermission('aprobacion-editar')){
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
    return back()->with('error','No tienes permisos');
    }

    public function sendEmailAprobacion(Request $request,$id){
    if(Auth::user()->hasPermission('aprobacion-eliminar')){
            $data = Http::post('http://localhost:6000/correos/search', [
                'funcion' => 'b',
                'cod_correo' => 2,
            ]);

            $correo = $data->json();
            $email = $correo[0][0]['CORREO'];
    
            if ($email==null) {
                return back()->withInput()
                            ->withErrors(["Correo no configurado, consulte a sistemas"]);             
            }

            Mail::to($email)->send(new Subscribe($email));

        return redirect()->route('getListaAprobacion')->with('mensaje','Correo enviado exitosamente');
        }
    return back()->with('error','No tienes permisos');
    }
}
