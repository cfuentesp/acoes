<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{
    public function getPersona(Request $request){
    if(Auth::user()->hasPermission('personas')){

        $data = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $data->json();
        return view('persona',compact('personas'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoPersona(Request $request){
    if(Auth::user()->hasPermission('personas-agregar')){

        return view('personaNuevo');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosPersona(Request $request, $id){
    if(Auth::user()->hasPermission('personas-editar')){

        $data = HTTP::post('http://localhost:6000/persona/search',[
            'funcion' => 'b',
            'cod_persona' => $id,
        ]);
        $personas = $data->json();
        $personas = $personas[0];

        $dataDos = HTTP::post('http://localhost:6000/direcciones/get',[
            'funcion' => 's',
            'cod_persona' => $id,
        ]);
        $direcciones = $dataDos->json();
        $direcciones = $direcciones[0];

        $dataTres = HTTP::post('http://localhost:6000/telefonos/get',[
            'funcion' => 's',
            'cod_persona' => $id,
        ]);
        $telefonos = $dataTres->json();
        $telefonos = $telefonos[0];
        return view('personaEditar',compact('personas','direcciones','telefonos'));
    }
    return back()->with('error','No tienes permisos');
    }

   
    public function updateDatosPersona(Request $request, $id){
    if(Auth::user()->hasPermission('personas-editar')){
        $validator = Validator::make($request->all(), [
            'nombres' => 'required',
            'apellidos' => 'required',
            'identidad' => 'required',
            'fecha_nacimiento' => 'required',
            'rol' => 'required',
            'numero_referencia' => 'required',
            'referencia' => 'required',
            'correo' => 'required',
            'sexo' => 'required',
        ],[
            'nombre.required' => 'Debe ingresar el nombre.',
            'apellido.required' => 'Debe ingresar el apellido.',
            'identidad.required' => 'Debe ingresar elnumero de identidad.',
            'fecha_nacimiento.required' => 'Debe ingresar la fecha de nacimiento.',
            'rol.required' => 'Debe ingresar el rol.',
            'telefono.required' => 'Debe ingresar el numero de telefono.',
            'direccion.required' => 'Debe ingresar la direccion.',
            'numero_referencia.required' => 'Debe ingresar el numero de telefono de la referencia.',
            'referencia.required' => 'Debe ingresar la referencia.',
            'correo.required' => 'Debe ingresar el correo.',
            'sexo.required' => 'Debe ingresar el tipo de sexo.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        HTTP::post('http://localhost:6000/persona/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_persona' => $id,
            'rol_persona' => $request->rol,
            'nom_persona' => $request->nombres,
            'apll_persona' => $request->apellidos,
            'num_identidad' => $request->identidad,
            'fec_nacimiento' => $request->fecha_nacimiento,
            'des_ref_persona' => $request->referencia,
            'num_ref_persona' => $request->numero_referencia,
            'cor_persona' => $request->correo,
            'sex_persona' => $request->sexo
        ]);
        return redirect()->route('getListaPersonas')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertPersona(Request $request){
    if(Auth::user()->hasPermission('personas-agregar')){
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
            'apellido.required' => 'Debe ingresar el apellido.',
            'identidad.required' => 'Debe ingresar elnumero de identidad.',
            'fecha_nacimiento.required' => 'Debe ingresar la fecha de nacimiento.',
            'rol.required' => 'Debe ingresar el rol.',
            'telefono.required' => 'Debe ingresar el numero de telefono.',
            'direccion.required' => 'Debe ingresar la direccion.',
            'num_referencia.required' => 'Debe ingresar el numero de telefono de la referencia.',
            'referencia.required' => 'Debe ingresar la referencia.',
            'correo.required' => 'Debe ingresar el correo.',
            'sex_persona.required' => 'Debe ingresar el tipo de sexo.'
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
    return back()->with('error','No tienes permisos');

    }

   public function deletePersona(Request $request,$id){
   if(Auth::user()->hasPermission('personas-eliminar')){

    HTTP::post('http://localhost:6000/persona/delete',[
        'funcion' => 'd',
        'cod_persona' => $id,
    ]);

    return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

   public function insertDireccion(Request $request,$id){
    if(Auth::user()->hasPermission('personas-agregar')){

    $validator = Validator::make($request->all(), [
        'direccion' => 'required',
    ],[
        'direccion.required' => 'Debe ingresar el direccion.',
    ]);

    if ($validator->fails()) {
        return back()->withInput()
                    ->withErrors($validator);            
    }

    HTTP::post('http://localhost:6000/direcciones/insert',[
        'funcion' => 'i',
        'usr_adicion' => auth()->user()->name,
        'cod_persona' => $id,
        'direccion' => $request->direccion,
    ]);

    return back()->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

   public function deleteDireccion(Request $request,$id){
    if(Auth::user()->hasPermission('personas-eliminar')){

    HTTP::post('http://localhost:6000/direcciones/delete',[
        'funcion' => 'd',
        'cod_direccion' => $id
    ]);
    return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

   public function insertTelefono(Request $request,$id){
    if(Auth::user()->hasPermission('personas-agregar')){

    $validator = Validator::make($request->all(), [
        'telefono' => 'required',
    ],[
        'telefono.required' => 'Debe ingresar el telefono.',
    ]);

    if ($validator->fails()) {
        return back()->withInput()
                    ->withErrors($validator);            
    }

    HTTP::post('http://localhost:6000/telefonos/insert',[
        'funcion' => 'i',
        'usr_adicion' => auth()->user()->name,
        'cod_persona' => $id,
        'telefono' => $request->telefono,
    ]);

    return back()->with('mensaje','Agregado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

   public function deleteTelefono(Request $request,$id){
    if(Auth::user()->hasPermission('personas-eliminar')){

    HTTP::post('http://localhost:6000/telefonos/delete',[
        'funcion' => 'd',
        'cod_telefono' => $id
    ]);
    return back()->with('mensaje','Eliminado exitosamente');
    
    }
    return back()->with('error','No tienes permisos');
    }
}