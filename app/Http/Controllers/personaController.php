<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class PersonaController extends Controller
{
    public function getPersona(Request $request){
        $data = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $data->json();
        return view('persona',compact('personas'));
    }

    public function nuevoPersona(Request $request){
        return view('personaNuevo');
    }

    public function getDatosPersona(Request $request, $id){
        $data = HTTP::post('http://localhost:6000/persona/search',[
            'funcion' => 'b',
            'cod_persona' => $id,
        ]);
        $personas = $data->json();
        $personas = $personas[0];
        return view('personaEditar',compact('personas'));
    }

   
    public function updateDatosPersona(Request $request, $id){
        HTTP::post('http://localhost:3004/persona/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_persona' => $id,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->clr_equipo,
            'num_equipo' => $request->num_equipo,
            'fec_ingreso' => $request->fec_ingreso
        ]);
        $inventario = Http::post('http://localhost:3004/persona/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventario',compact('equipos'));
    }

    public function insertPersona(Request $request){
        //if(Auth::user()->hasPermission('inventario-agregar')){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'identidad' => 'required',
            'fecha_nacimiento' => 'required',
            'rol' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'num_referencia' => 'required',
            'referencia' => 'required',
            'correo' => 'required',
            'sex_persona' => 'required',
        ],[
            'nombre.required' => 'Debe ingresar el nombre.',
            'apellido.required' => 'Debe ingresar la marca del equipo.',
            'identidad.required' => 'Debe ingresar el modelo/serie del equipo.',
            'fecha_nacimiento.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'rol.required' => 'Debe ingresar el color del equipo.',
            'telefono.required' => 'Debe ingresar el numero del equipo.',
            'direccion.required' => 'Debe ingresar la fecha de ingreso del equipo.',
            'num_referencia.required' => 'Debe ingresar la fecha de ingreso del equipo.',
            'referencia.required' => 'Debe ingresar la fecha de ingreso del equipo.',
            'correo.required' => 'Debe ingresar la fecha de ingreso del equipo.',
            'sex_persona.required' => 'Debe ingresar la fecha de ingreso del equipo.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        HTTP::post('http://localhost:6000/persona/insert',[
            'usr_adicion' => auth()->user()->name,
            'nom_persona' => $request->nombre,
            'apll_persona' => $request->apellido,
            'identidad' => $request->identidad,
            'fec_nacimiento' => $request->fecha_nacimiento,
            'sex_persona' =>$request->sex_persona,
            'rol_persona' => $request->rol,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'referencia' => $request->num_referencia,
            'num_referencia' => $request->referencia,
            'cor_persona' => $request->correo
        ]);

        return redirect()->route('getListaPersonas')->with('mensaje','Agregado exitosamente');
    }
   // return back()->with('error','No tienes permisos');
   // }
}