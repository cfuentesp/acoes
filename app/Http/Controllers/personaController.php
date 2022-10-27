<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        return view('personaNuevo',compact('header'));
    }

    public function getDatosPersona(Request $request, $id){
        $header = "Editar datos de personas";
        $persona = HTTP::post('http://localhost:6000/persona/search',[
            'funcion' => 'b',
            'cod_persona' => $id,
        ]);
        $tiempo = $persona->json();
        return view('personaEditar',compact('tiempo','header'));
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
    
    
}