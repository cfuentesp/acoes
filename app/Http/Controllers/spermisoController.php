<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\permiso;

class spermisoController extends Controller
{
    public function getPermisos(Request $request){
    if(Auth::user()->hasPermission('permisos')){
        $data = Http::post('http://localhost:6000/permiso/get', [
            'funcion' => 's',
        ]);
        $permisos = $data->json();
        $permisos = $permisos[0];
        return view('spermisoLista',compact('permisos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoPermiso(Request $request){
    if(Auth::user()->hasPermission('permisos-agregar')){
        $data = Http::post('http://localhost:6000/persona/get', [
            'funcion' => 's',
        ]);
        $personas = $data->json();
        $personas = $personas[0];

        $dataTres = HTTP::post('http://localhost:6000/correos/search',[
            'funcion' => 'b',
            'cod_correo' => 1
        ]);
        $correo = $dataTres->json();
        $correo = $correo[0];
        return view('spermisoNuevo',compact('personas','correo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertPermiso(Request $request){
    if(Auth::user()->hasPermission('permisos-agregar')){
        //Validar campos vacios
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'required',
            'descripcion' => 'required',
            'inicio_permiso' => 'required',
            'final_permiso' => 'required',
            'cod_persona' => 'required',
        ],[
            'tipo_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'descripcion.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'inicio_permiso.required' => 'Debe ingresar la fecha en que inicia el permiso.',
            'final_permiso.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
            'cod_persona.required' => 'Debe ingresar el nombre solicitante.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }
        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'regex:/^[a-zA-Z\s]+$/u',
            'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
            'inicio_permiso' => 'required|date|after:2000-01-01',
            'final_permiso' => 'required|date|after:2000-01-01',
        ],[
            'tipo_solicitud.regex' => 'Tipo de solicitud solo debe contener letras.',
            'descripcion.regex' => 'Descripcion de solicitud solo debe tener letras y numeros.',
            'inicio_permiso.after' => 'Ingrese una fecha de inicio valida.',
            'final_permiso.after' => 'Ingrese una fecha  final valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        $pieces = explode("-", $request->inicio_permiso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de inicio valida');
                        
        }

          //Validar caracteres especiales
          $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'max:60',
            'descripcion' => 'max:1499',
            'inicio_permiso' => 'before:01/01/2050',
            'final_permiso' => 'before:01/01/2050',
        ],[
            'tipo_solicitud.max' => 'Tipo de solicitud contiene demasiados caracteres.',
            'descripcion.max' => 'Descripcion de solicitud contiene demasiados caracteres.',
            'inicio_permiso.before' => 'Ingrese una fecha de inicio valida.',
            'final_permiso.before' => 'Ingrese una fecha final valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        $pieces = explode("-", $request->final_permiso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha final valida');
                        
        }

        if ($request->inicio_permiso>$request->final_permiso) {
            return back()->withInput()
                        ->with('error','La fecha de inicio no puede ser mayor a la fecha final del permiso');             
        }

        $codigo = HTTP::post('http://localhost:6000/permiso/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'cod_persona' => $request->cod_persona,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion,
            'fec_solicitud' => date("Y-m-d"),
            'fec_inicio' => $request->inicio_permiso,
            'fec_final' => $request->final_permiso,
        ]);

        $dato = $codigo->json();
        $id = $dato[0][0]['id'];
        
        if($request->checkbox=='on'){
        $data = Http::post('http://localhost:6000/correos/search', [
            'funcion' => 'b',
            'cod_correo' => 1,
        ]);

        $correo = $data->json();
        $email = $correo[0][0]['CORREO'];

        if ($email==null) {
            return back()->withInput()
                        ->withErrors(["Correo no configurado, consulte a sistemas"]);             
        }

        $datos = Http::post('http://localhost:6000/permiso/search', [
            'funcion' => 'b',
            'cod_sol_permiso' => $id,
        ]);

        $solicitud = $datos->json();
        $solicitud = $solicitud[0];

        $body = [
            'header' => 'SOLICITUD DE PERMISO LABORAL',
            'tipo' => $solicitud[0]['TIP_SOLICITUD'],
            'descripcion' => $solicitud[0]['DES_SOLICITUD'],
            'solicitante' => $solicitud[0]['NOM_PERSONA'].' '.$solicitud[0]['APLL_PERSONA'],
            'inicio' => date("Y-m-d", strtotime($solicitud[0]['FEC_INICIO'])),
            'final' => date("Y-m-d", strtotime($solicitud[0]['FEC_FINAL'])),
            'urlapb' => 'http://acoes-apps.eastus.cloudapp.azure.com/acoes-admin/permiso/aprobar/'.$id, 
            'urlrch' => 'http://acoes-apps.eastus.cloudapp.azure.com/acoes-admin/permiso/rechazar/'.$id,
        ];
    
        Mail::to($email)->send(new permiso($body));

        Http::post('http://localhost:6000/permiso/result', [
            'funcion' => 'r',
            'cod_sol_permiso' => $id,
            'ind_solicitud' => "Enviada",
        ]);

        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Correo enviado exitosamente');
    }

        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deletePermiso(Request $request,$id){
    if(Auth::user()->hasPermission('permisos-eliminar')){
        Http::post('http://localhost:6000/permiso/delete', [
            'funcion' => 'd',
            'cod_sol_permiso' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosPermiso(Request $request, $id){
    if(Auth::user()->hasPermission('permisos-editar')){
        $data = HTTP::post('http://localhost:6000/permiso/search',[
            'funcion' => 'b',
            'cod_sol_permiso' => $id,
        ]);
        $permiso = $data->json();
        $permiso = $permiso[0];

        $dataTres = HTTP::post('http://localhost:6000/correos/search',[
            'funcion' => 'b',
            'cod_correo' => 1
        ]);
        $correo = $dataTres->json();
        $correo = $correo[0];

        return view('spermisoEditar',compact('permiso','correo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosPermiso(Request $request, $id){
    if(Auth::user()->hasPermission('permisos-editar')){
               //Validar campos vacios
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'required',
            'descripcion' => 'required',
            'inicio_permiso' => 'required',
            'final_permiso' => 'required',
            'cod_persona' => 'required',
        ],[
            'tipo_solicitud.required' => 'Debe ingresar el tipo de solicitud de permiso.',
            'descripcion.required' => 'Debe ingresar la descripcion de solicitud de permiso.',
            'inicio_permiso.required' => 'Debe ingresar la fecha en que inicia el permiso.',
            'final_permiso.required' => 'Debe ingresar la fecha en que finaliza el permiso.',
            'cod_persona.required' => 'Debe ingresar el nombre solicitante.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }
        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'regex:/^[a-zA-Z\s]+$/u',
            'descripcion' => 'regex:/^[A-Za-z0-9\s]+$/u',
            'inicio_permiso' => 'required|date|after:2000-01-01',
            'final_permiso' => 'required|date|after:2000-01-01',
        ],[
            'tipo_solicitud.regex' => 'Tipo de solicitud solo debe contener letras.',
            'descripcion.regex' => 'Descripcion de solicitud solo debe tener letras y numeros.',
            'inicio_permiso.after' => 'Ingrese una fecha valida.',
            'final_permiso.after' => 'Ingrese una fecha valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        $pieces = explode("-", $request->inicio_permiso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de inicio valida');
                        
        }

          //Validar caracteres especiales
          $validator = Validator::make($request->all(), [
            'tipo_solicitud' => 'max:60',
            'descripcion' => 'max:1499',
            'inicio_permiso' => 'before:01/01/2050',
            'final_permiso' => 'before:01/01/2050',
        ],[
            'tipo_solicitud.max' => 'Tipo de solicitud contiene demasiados caracteres.',
            'descripcion.max' => 'Descripcion de solicitud contiene demasiados caracteres.',
            'inicio_permiso.before' => 'Ingrese una fecha valida.',
            'final_permiso.before' => 'Ingrese una fecha valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);             
        }

        $pieces = explode("-", $request->final_permiso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha final valida');
                        
        }

        if ($request->inicio_permiso>$request->final_permiso) {
            return back()->withInput()
                        ->with('error','La fecha de inicio no puede ser mayor a la fecha final del permiso');             
        }

        HTTP::post('http://localhost:6000/permiso/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_sol_permiso' => $id,
            'tip_solicitud' => $request->tipo_solicitud,
            'des_solicitud' => $request->descripcion,
            'fec_inicio' => $request->inicio_permiso,
            'fec_final' => $request->final_permiso,
            'ind_solicitud' => $request->estado
        ]);
        return redirect()->route('getListaPermisosLaborales')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function sendEmailPermiso(Request $request,$id){
        if(Auth::user()->hasPermission('permisos-correo')){
                $data = Http::post('http://localhost:6000/correos/search', [
                    'funcion' => 'b',
                    'cod_correo' => 1,
                ]);
    
                $correo = $data->json();
                $email = $correo[0][0]['CORREO'];
        
                if ($email==null) {
                    return back()->withInput()
                                ->withErrors(["Correo no configurado, consulte a sistemas"]);             
                }
    
                $datos = Http::post('http://localhost:6000/permiso/search', [
                    'funcion' => 'b',
                    'cod_sol_permiso' => $id,
                ]);
    
                $solicitud = $datos->json();
                $solicitud = $solicitud[0];
    
                $body = [
                    'header' => 'SOLICITUD DE PERMISO LABORAL',
                    'tipo' => $solicitud[0]['TIP_SOLICITUD'],
                    'descripcion' => $solicitud[0]['DES_SOLICITUD'],
                    'solicitante' => $solicitud[0]['NOM_PERSONA'].' '.$solicitud[0]['APLL_PERSONA'],
                    'inicio' => $solicitud[0]['FEC_INICIO'],
                    'final' => $solicitud[0]['FEC_FINAL'],
                    'urlapb' => 'http://127.0.0.1:8000/permiso/aprobar/'.$id, 
                    'urlrch' => 'http://127.0.0.1:8000/permiso/rechazar'.$id,
                ];
            
                Mail::to($email)->send(new permiso($body));

                Http::post('http://localhost:6000/permiso/result', [
                    'funcion' => 'r',
                    'cod_sol_permiso' => $id,
                    'ind_solicitud' => "Enviada",
                ]);
    
            return redirect()->route('getListaPermisosLaborales')->with('mensaje','Correo enviado exitosamente');
            }
        return back()->with('error','No tienes permisos');
        }
    
        public function aprobarSolicitudper(Request $request, $id){
            Http::post('http://localhost:6000/permiso/result', [
                'funcion' => 'r',
                'cod_sol_permiso' => $id,
                'ind_solicitud' => "Aprobado",
            ]);
    
            $estado = "Aprobada";
            return view('dictamen',compact('estado'));
        }
    
        public function rechazarSolicitudper(Request $request, $id){
            Http::post('http://localhost:6000/permiso/result', [
                'funcion' => 'r',
                'cod_sol_permiso' => $id,
                'ind_solicitud' => "Rechazado",
            ]);
            $estado = "Rechazada";
            return view('dictamen',compact('estado'));
        }
}
