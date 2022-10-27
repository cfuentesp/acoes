<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class inventarioController extends Controller
{
    public function getInventario(Request $request){
        $inventario = Http::post('http://localhost:3004/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventario',compact('equipos'));
    }

    public function nuevoEquipo(Request $request){
        $header = "Agregar nuevo equipo";
        return view('inventarioNuevo',compact('header'));
    }

    public function getDatosEquipo(Request $request, $id){
        $datos = HTTP::post('http://localhost:3004/inventario/search',[
            'funcion' => 'b',
            'cod_equipo' => $id,
        ]);
        $equipo = $datos->json();
        $equipo = $equipo[0];
        return view('inventarioEditar',compact('equipo'));
    }

    public function updateDatosEquipo(Request $request, $id){
        HTTP::post('http://localhost:3004/inventario/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_equipo' => $id,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->clr_equipo,
            'num_equipo' => $request->num_equipo,
            'fec_ingreso' => $request->fec_ingreso
        ]);
        $inventario = Http::post('http://localhost:3004/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventario',compact('equipos'));
    }
}
