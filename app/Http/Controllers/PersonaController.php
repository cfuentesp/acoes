<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PersonaController extends Controller
{
    public function getPersona(Request $request){
        $persona = HTTP::get('http://localhost:3000/persona');
        $tiempo = $persona->json();
        return view('persona',compact('tiempo'));
    }

    public function nuevoPersona(Request $request){
        $header = "Agregar Nueva Persona";
        return view('personaNuevo',compact('header'));
    }

    public function getDatosPersona(Request $request){
        $header = "Editar datos de personas";
        $persona = HTTP::get('http://localhost:3000/persona/editar',[
            'cod_persona' => $request['id'],
        ]);
        $tiempo = $persona->json();
        return view('personaEditar',compact('tiempo','header'));
    }

    public function actualizar(Request $request){
        dd('ACOES');
    }
    
    
}
