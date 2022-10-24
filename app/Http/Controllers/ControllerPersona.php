<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class inventarioController extends Controller
{
    public function getPersona(Request $request){
        $persona = HTTP::get('http://localhost:3000/persona');
        $equipos = $persona->json();
        return view('persona',compact('equipos'));
    }

    public function RegistroPersona(Request $request){
        $header = "Agregar Persona";
        return view('NuevaPersona',compact('header'));
    }

    public function getDatosPersona(Request $request){
        $header = "Editar datos de persona";
        $persona = HTTP::get('http://localhost:3000/persona/editar',[
            'cod_persona' => $request['id'],
        ]);
        $equipo = $persona->json();
        return view('PersonaEditar',compact('equipo','header'));
    }

    public function actualizar(Request $request){
        dd('create');
    }
}
