<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\compra;

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
        if ($request->cod_solicitud==null) {
            return back()->withInput()
                        ->with('error','Seleccione una solicitud aprobada.');
                        
        }
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
        //Validar campos vacios
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

        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'fecha_solicitud' => 'required|date|after:2000-01-01',
            'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
        ],[
            'fecha_solicitud.after' => 'Ingrese una fecha valida.',
            'descripcion.regex' => 'Descripcion de la solicitud solo debe contener letras y numeros.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

         //Validar cantidad caracteres
         $validator = Validator::make($request->all(), [
            'fecha_solicitud' => 'before:01/01/2050',
            'descripcion' => 'max:1499',
        ],[
            'fecha_solicitud.before' => 'Ingrese una fecha valida.',
            'descripcion.max' => 'Descripcion de la solicitud contiene demasiados caracteres.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        $pieces = explode("-", $request->fecha_solicitud);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha valida');
                        
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

        $dataDos = HTTP::post('http://localhost:6000/correos/search',[
            'funcion' => 'b',
            'cod_correo' => 2
        ]);
        $correo = $dataDos->json();
        $correo = $correo[0];

        return view('scompraEditar',compact('datos','correo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosCompra(Request $request, $id){
    if(Auth::user()->hasPermission('compras-editar')){
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

        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'fecha_solicitud' => 'required|date|after:2000-01-01',
            'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
        ],[
            'fecha_solicitud.after' => 'Ingrese una fecha valida.',
            'descripcion.regex' => 'Descripcion de la solicitud solo debe contener letras y numeros.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

         //Validar cantidad caracteres
         $validator = Validator::make($request->all(), [
            'fecha_solicitud' => 'before:01/01/2050',
            'descripcion' => 'max:1499',
        ],[
            'fecha_solicitud.before' => 'Ingrese una fecha valida.',
            'descripcion.max' => 'Descripcion de la solicitud contiene demasiados caracteres.',
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

    public function sendEmailCompra(Request $request,$id){
        if(Auth::user()->hasPermission('compras-correo')){
                $data = Http::post('http://localhost:6000/correos/search', [
                    'funcion' => 'b',
                    'cod_correo' => 3,
                ]);
    
                $correo = $data->json();
                $email = $correo[0][0]['CORREO'];
        
                if ($email==null) {
                    return back()->withInput()
                                ->withErrors(["Correo no configurado, consulte a sistemas"]);             
                }
    
                $datos = Http::post('http://localhost:6000/compra/search', [
                    'funcion' => 'b',
                    'cod_sol_compra' => $id,
                ]);
    
                $solicitud = $datos->json();
                $solicitud = $solicitud[0];
    
                $body = [
                    'header' => 'SOLICITUD DE COMPRA DE EQUIPO',
                    'descripcion' => $solicitud[0]['DES_SOLICITUD'],
                    'cotizacion' => $solicitud[0]['COZ_EQUIPO'],
                    'solucion' => $solicitud[0]['SOL_PROBLEMA'],
                ];
            
                Mail::to($email)->send(new compra($body));
                
                $datos = Http::post('http://localhost:6000/compra/result', [
                    'funcion' => 'r',
                    'cod_sol_compra' => $id,
                    'ind_solicitud' => "Enviada",
                ]);
    
            return redirect()->route('getListaCompras')->with('mensaje','Correo enviado exitosamente');
            }
        return back()->with('error','No tienes permisos');
        }
}
