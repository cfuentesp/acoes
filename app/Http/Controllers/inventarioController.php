<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class inventarioController extends Controller
{
    public function getInventario(Request $request){
        $inventario = HTTP::get('http://localhost:3000/inventario');
        $equipos = $inventario->json();
        return view('inventario',compact('equipos'));
    }

    public function nuevoEquipo(Request $request){
        $header = "Agregar nuevo equipo";
        return view('inventarioNuevo',compact('header'));
    }

    public function getDatosEquipo(Request $request){
        $header = "Editar datos de equipo";
        $inventario = HTTP::get('http://localhost:3000/inventario/editar',[
            'cod_equipo' => $request['id'],
        ]);
        $equipo = $inventario->json();
        return view('inventarioEditar',compact('equipo','header'));
    }

    public function actualizar(Request $request){
        dd('hola');
    }
}
