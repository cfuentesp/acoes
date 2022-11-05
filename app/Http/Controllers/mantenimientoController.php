<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class mantenimientoController extends Controller
{
    public function getMantenimiento(Request $request){
        $mantenimiento = HTTP::get('http://localhost:3000/mantenimiento');
        $mante = $mantenimiento->json();
        return view('mantenimiento',compact('mante'));
    }

    public function nuevoMantenimiento(Request $request){
        $header = "Agregar Nuevo Registro";
        return view('mantenimientoNuevo',compact('header'));
    }

    public function getDatosMantenimiento(Request $request){
        $header = "Editar datos de mantenimiento";
        $mantenimiento = HTTP::get('http://localhost:3000/mantenimiento/editar',[
            'cod_mantenimiento' => $request['id'],
        ]);
        $mante = $mantenimiento->json();
        return view('mantenimientoEditar',compact('mante','header'));
    }

    public function actualizar(Request $request){
        dd('ACOES');
    }
    
    
}