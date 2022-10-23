<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function getInventario(Request $request){
        $inventario = HTTP::get('http://localhost:3000/inventario',[
            'funcion' => 's',
            'cod_equipo' => 2
        ]);
        $equipos = $inventario->json();
        return view('inventario',compact('equipos'));
    }
}
