<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class inventarioController extends Controller
{
    public function getInventario(Request $request){
        if(Auth::user()->hasPermission('inventario')){
        $data = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $data->json();
        return view('inventarioLista',compact('equipos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoEquipo(Request $request){
        if(Auth::user()->hasPermission('inventario-agregar')){
        return view('inventarioNuevo');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertEquipo(Request $request){
        if(Auth::user()->hasPermission('inventario-agregar')){
        //Validacion de campos vacios
        $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'required',
            'marca_equipo' => 'required',
            'modelo_serie' => 'required',
            'especificaciones' => 'required',
            'color_equipo' => 'required',
            'numero_equipo' => 'required',
            'fecha_ingreso' => 'required',
        ],[
            'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
            'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
            'modelo_serie.required' => 'Debe ingresar el modelo/serie del equipo.',
            'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'color_equipo.required' => 'Debe ingresar el color del equipo.',
            'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        //Validacion de caracteres especiales
           $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
            'marca_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
            'modelo_serie' => 'alpha_dash',
            'especificaciones' => 'regex:/^[A-Za-z0-9\s]+$/u',
            'color_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
            'numero_equipo' => 'alpha_num',
            'fecha_ingreso' => 'required|date|after:2000-01-01',
        ],[
            'tipo_equipo.regex' => 'Tipo de equipo solo debe contener letras.',
            'marca_equipo.regex' => 'Marca de equipo solo debe contener letras.',
            'modelo_serie.alpha_dash' => 'Modelo/serie solo debe contener letras, numeros, y guiones.',
            'especificaciones.regex' => 'Especificaciones tecnicas solo debe contener letras y numeros.',
            'color_equipo.regex' => 'Color de equipo solo debe contener letras.',
            'numero_equipo.alpha_num' => 'Numero de equipo solo debe contener numeros.',
            'fecha_ingreso.after' => 'Debe ingresar una fecha valida.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }
          //Validacion de cantidadad de caracteres
          $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'max:60',
            'marca_equipo' => 'max:60',
            'modelo_serie' => 'max:60',
            'especificaciones' => 'max:1499',
            'color_equipo' => 'max:60',
            'fecha_ingreso' => 'before:01/01/2050',
            'numero_equipo' => 'required|numeric|min:0|not_in:0',
        ],[
            'tipo_equipo.max' => 'Tipo de equipo contiene demasiados caracteres.',
            'marca_equipo.max' => 'Marca de equipo contiene demasiados caracteres.',
            'modelo_serie.max' => 'Modelo/serie contiene demasiados caracteres.',
            'especificaciones.max' => 'Especificaciones tecnicas contiene demasiados caracteres.',
            'numero_equipo.max' => 'Numero de equipo contiene demasiados caracteres.',
            'fecha_ingreso.before' => 'Debe ingresar una fecha valida.',
            'numero_equipo.not_in' => 'Debe ingresar un numero de equipo valido',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        $validator = Validator::make($request->all(), [
            'numero_equipo' => 'max:5',
        ],[
            'numero_equipo.max' => 'Numero de equipo contiene demasiados caracteres.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        
        $pieces = explode("-", $request->fecha_ingreso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de ingreso valida');
                        
        }

        HTTP::post('http://localhost:6000/inventario/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);

        return redirect()->route('getListaEquipos')->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteEquipo(Request $request,$id){
        if(Auth::user()->hasPermission('inventario-eliminar')){
        Http::post('http://localhost:6000/inventario/delete', [
            'funcion' => 'd',
            'cod_equipo' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosEquipo(Request $request, $id){
        if(Auth::user()->hasPermission('inventario-eliminar')){
        $datos = HTTP::post('http://localhost:6000/inventario/search',[
            'funcion' => 'b',
            'cod_equipo' => $id,
        ]);
        $equipo = $datos->json();
        $equipo = $equipo[0];
        $equipo[0]['FEC_INGRESO']=date("Y-m-d", strtotime($equipo[0]['FEC_INGRESO']));
        return view('inventarioEditar',compact('equipo'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateDatosEquipo(Request $request, $id){
        if(Auth::user()->hasPermission('inventario-editar')){
              //Validacion de campos vacios
              $validator = Validator::make($request->all(), [
                'tipo_equipo' => 'required',
                'marca_equipo' => 'required',
                'modelo_serie' => 'required',
                'especificaciones' => 'required',
                'color_equipo' => 'required',
                'numero_equipo' => 'required',
                'fecha_ingreso' => 'required',
            ],[
                'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
                'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
                'modelo_serie.required' => 'Debe ingresar el modelo/serie del equipo.',
                'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
                'color_equipo.required' => 'Debe ingresar el color del equipo.',
                'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
                'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);            
            }
    
            //Validacion de caracteres especiales
               $validator = Validator::make($request->all(), [
                'tipo_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
                'marca_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
                'modelo_serie' => 'alpha_dash',
                'especificaciones' => 'regex:/^[A-Za-z0-9\s]+$/u',
                'color_equipo' => 'regex:/^[a-zA-Z\s]+$/u',
                'numero_equipo' => 'alpha_num',
                'fecha_ingreso' => 'required|date|after:2000-01-01',
            ],[
                'tipo_equipo.regex' => 'Tipo de equipo solo debe contener letras.',
                'marca_equipo.regex' => 'Marca de equipo solo debe contener letras.',
                'modelo_serie.alpha_dash' => 'Modelo/serie solo debe contener letras, numeros y guiones.',
                'especificaciones.regex' => 'Especificaciones tecnicas solo debe contener letras y numeros.',
                'color_equipo.regex' => 'Color de equipo solo debe contener letras.',
                'numero_equipo.alpha_num' => 'Numero de equipo solo debe contener numeros.',
                'fecha_ingreso.after' => 'Debe ingresar una fecha valida.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);            
            }
    
          //Validacion de cantidadad de caracteres
          $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'max:60',
            'marca_equipo' => 'max:60',
            'modelo_serie' => 'max:60',
            'especificaciones' => 'max:1499',
            'color_equipo' => 'max:60',
            'fecha_ingreso' => 'before:01/01/2050',
            'numero_equipo' => 'required|numeric|min:0|not_in:0',
        ],[
            'tipo_equipo.max' => 'Tipo de equipo contiene demasiados caracteres.',
            'marca_equipo.max' => 'Marca de equipo contiene demasiados caracteres.',
            'modelo_serie.max' => 'Modelo/serie contiene demasiados caracteres.',
            'especificaciones.max' => 'Especificaciones tecnicas contiene demasiados caracteres.',
            'numero_equipo.max' => 'Numero de equipo contiene demasiados caracteres.',
            'fecha_ingreso.before' => 'Debe ingresar una fecha valida.',
            'numero_equipo.not_in' => 'Debe ingresar un numero de equipo valido',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        $validator = Validator::make($request->all(), [
            'numero_equipo' => 'max:5',
        ],[
            'numero_equipo.max' => 'Numero de equipo contiene demasiados caracteres.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        $pieces = explode("-", $request->fecha_ingreso);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de ingreso valida');
                        
        }

        HTTP::post('http://localhost:6000/inventario/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_equipo' => $id,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);
        return redirect()->route('getListaEquipos')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}
