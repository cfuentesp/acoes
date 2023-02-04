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
                //Validar campos nulos
                $validator = Validator::make($request->all(), [
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'identidad' => 'required',
                    'fecha_nacimiento' => 'required',
                    'rol' => 'required',
                    'num_referencia' => 'required',
                    'referencia' => 'required',
                    'correo' => 'required',
                    'sexo' => 'required',
                ],[
                    'nombre.required' => 'Debe ingresar el nombre.',
                    'apellido.required' => 'Debe ingresar el apellido.',
                    'identidad.required' => 'Debe ingresar elnumero de identidad.',
                    'fecha_nacimiento.required' => 'Debe ingresar la fecha de nacimiento.',
                    'rol.required' => 'Debe ingresar el rol.',
                    'num_referencia.required' => 'Debe ingresar el numero de telefono de la referencia.',
                    'referencia.required' => 'Debe ingresar la referencia.',
                    'correo.required' => 'Debe ingresar el correo.',
                    'sexo.required' => 'Debe ingresar el tipo de sexo.'
                ]);
        
                if ($validator->fails()) {
                    return back()->withInput()
                                ->withErrors($validator);            
                }
        
                //Validar caracteres especiales
                $validator = Validator::make($request->all(), [
                    'nombre' => 'regex:/^[a-zA-Z\s]+$/u',
                    'apellido' => 'regex:/^[a-zA-Z\s]+$/u',
                    'identidad' => 'alpha_num',
                    'fecha_nacimiento' => 'required|date|after: 1900-01-01',
                    'rol' => 'regex:/^[a-zA-Z\s]+$/u',
                    'num_referencia' => 'alpha_num',
                    'referencia' => 'regex:/^[a-zA-Z\s]+$/u',
                    'sex_persona' => 'regex:/^[a-zA-Z\s]+$/u',
                ],[
                    'nombre.regex' => 'Nombre solo debe contener letras.',
                    'apellido.regex' => 'Apellido solo debe contener letras.',
                    'identidad.alpha_num' => 'Idenditad solo debe contener numeros.',
                    'fecha_nacimiento.after' => 'Ingrese una fecha de nacimiento valida.',
                    'rol.regex' => 'Rol solo debe contener letras.',
                    'num_referencia.alpha_num' => 'Numero de referencia solo debe contener numeros.',
                    'referencia.regex' => 'Referencia personal solo debe tener letras.',
                    'sex_persona.regex' => 'Sexo de la persona solo debe tener letras.'
                ]);
        
                if ($validator->fails()) {
                    return back()->withInput()
                                ->withErrors($validator);            
                }

                
                if ($request->identidad==0) {
                    return back()->withInput()
                                ->with('error','Ingrese un numero de identidad valido');            
                }
        
                if ($request->num_referencia==0) {
                    return back()->withInput()
                                ->with('error','Ingrese un telefono de referencia valido');            
                }
        
                $pieces = explode("-", $request->fecha_nacimiento);
                if (strlen($pieces[0])>4) {
                    return back()->withInput()
                                ->with('error','Ingrese una fecha de nacimiento valida');
                                
                }
               
                //Validar cantidad caracteres
                       $validator = Validator::make($request->all(), [
                        'nombre' => 'max:20',
                        'apellido' => 'max:20',
                        'identidad' => 'max:15',
                        'fecha_nacimiento' => 'before:12/12/2022',
                        'rol' => 'max:50',
                        'num_referencia' => 'max:8',
                        'referencia' => 'max:60',
                        'sex_persona' => 'max:20',
                    ],[
                        'nombre.max' => 'Nombre contiene demasiados caracteres.',
                        'apellido.max' => 'Apellido contiene demasiados caracteres.',
                        'identidad.max' => 'Idenditad contiene demasiados numeros.',
                        'fecha_nacimiento.before' => 'Ingrese una fecha de nacimiento valida.',
                        'rol.regex' => 'Rol contiene demasiados caracteress.',
                        'num_referencia.max' => 'Numero de referencia contiene demasiados numeros.',
                        'referencia.max' => 'Referencia contiene demasiados caracteres.',
                        'sex_persona.max' => 'Sexo de la persona contiene demasiados caracteres.'
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
            'nom_persona' => $request->nombre,
            'apll_persona' => $request->apellido,
            'num_identidad' => $request->identidad,
            'fec_nacimiento' => $request->fecha_nacimiento,
            'des_ref_persona' => $request->referencia,
            'num_ref_persona' => $request->num_referencia,
            'cor_persona' => $request->correo,
            'sex_persona' => $request->sexo
        ]);
        return redirect()->route('getListaPersonas')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertPersona(Request $request){
    if(Auth::user()->hasPermission('personas-agregar')){
        //Validar campos nulos
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

        //Validar caracteres especiales
        $validator = Validator::make($request->all(), [
            'nombre' => 'regex:/^[a-zA-Z\s]+$/u',
            'apellido' => 'regex:/^[a-zA-Z\s]+$/u',
            'identidad' => 'alpha_num',
            'fecha_nacimiento' => 'required|date|after: 1900-01-01',
            'rol' => 'regex:/^[a-zA-Z\s]+$/u',
            'telefono' => 'alpha_num',
            'direccion' => 'regex:/^[A-Za-z0-9\s]+$/u',
            'num_referencia' => 'alpha_num',
            'referencia' => 'regex:/^[a-zA-Z\s]+$/u',
            'sex_persona' => 'regex:/^[a-zA-Z\s]+$/u',
        ],[
            'nombre.regex' => 'Nombre solo debe contener letras.',
            'apellido.regex' => 'Apellido solo debe contener letras.',
            'identidad.alpha_num' => 'Idenditad solo debe contener numeros.',
            'fecha_nacimiento.after' => 'Ingrese una fecha de nacimiento valida.',
            'rol.regex' => 'Rol solo debe contener letras.',
            'telefono.alpha_num' => 'Telefono solo debe contener numeros.',
            'direccion.regex' => 'Direccion solo debe contener letras y numeros.',
            'num_referencia.alpha_num' => 'Numero de referencia solo debe contener numeros.',
            'referencia.regex' => 'Referencia personal solo debe tener letras.',
            'sex_persona.regex' => 'Sexo de la persona solo debe tener letras.'
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        if ($request->identidad==0) {
            return back()->withInput()
                        ->with('error','Ingrese un numero de identidad valido');            
        }

        if ($request->telefono==0) {
            return back()->withInput()
                        ->with('error','Ingrese un telefono valido');            
        }

        if ($request->num_referencia==0) {
            return back()->withInput()
                        ->with('error','Ingrese un telefono de referencia valido');            
        }

        $pieces = explode("-", $request->fecha_nacimiento);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de nacimiento valida');
                        
        }

        //Validar cantidad caracteres
               $validator = Validator::make($request->all(), [
                'nombre' => 'max:20',
                'apellido' => 'max:20',
                'identidad' => 'max:15',
                'fecha_nacimiento' => 'before:12/12/2022',
                'rol' => 'max:50',
                'telefono' => 'max:8',
                'direccion' => 'max:499',
                'num_referencia' => 'max:8',
                'referencia' => 'max:60',
                'sex_persona' => 'max:20',
            ],[
                'nombre.max' => 'Nombre contiene demasiados caracteres.',
                'apellido.max' => 'Apellido contiene demasiados caracteres.',
                'identidad.max' => 'Idenditad contiene demasiados numeros.',
                'fecha_nacimiento.before' => 'Ingrese una fecha de nacimiento valida.',
                'rol.regex' => 'Rol contiene demasiados caracteress.',
                'telefono.max' => 'Telefono contiene demasiados numeros.',
                'direccion.max' => 'Direccion contiene demasiados caracteres.',
                'num_referencia.max' => 'Numero de referencia contiene demasiados numeros.',
                'referencia.max' => 'Referencia contiene demasiados caracteres.',
                'sex_persona.max' => 'Sexo de la persona contiene demasiados caracteres.'
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
            'referencia' => $request->referencia,
            'num_referencia' => $request->num_referencia,
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

    $validator = Validator::make($request->all(), [
        'direccion' => 'regex:/^[A-Za-z0-9\s]+$/u',
    ],[
        'direccion.regex' => 'Direccion solo debe contener letras y numeros.',
    ]);

    if ($validator->fails()) {
        return back()->withInput()
                    ->withErrors($validator);            
    }

    $validator = Validator::make($request->all(), [
        'direccion' => 'max:499',
    ],[
        'direccion.max' => 'Direccion contiene demasiados caracteres.',
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

    $validator = Validator::make($request->all(), [
        'telefono' => 'alpha_num',
    ],[
        'telefono.alpha_num' => 'Telfono solo debe contener numeros.',
    ]);

    if ($validator->fails()) {
        return back()->withInput()
                    ->withErrors($validator);            
    }

    $validator = Validator::make($request->all(), [
        'telefono' => 'max:8',
    ],[
        'telefono.max' => 'Telefono contiene demasiados numeros.',
    ]);

    if ($validator->fails()) {
        return back()->withInput()
                    ->withErrors($validator);            
    }

    if ($request->telefono==0) {
        return back()->withInput()
                    ->with('error','Ingrese un telefono valido');            
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