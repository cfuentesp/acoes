<?php

namespace App\Http\Controllers;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mantenimiento = DB::select('SELECT * FROM tbl_dis_mantenimiento WHERE ESTATUS = 0');
        $aprobacion = DB::select("SELECT * FROM tbl_sol_apb_compra WHERE IND_SOLICITUD = 'Pendiente' OR IND_SOLICITUD = 'Enviada'");
        $compras = DB::select("SELECT * FROM tbl_sol_compra WHERE IND_SOLICITUD = 'Pendiente' OR IND_SOLICITUD = 'Enviada'");
        $permisos = DB::select("SELECT * FROM tbl_sol_prm_laboral WHERE IND_SOLICITUD = 'Pendiente' OR IND_SOLICITUD ='Enviada'");

        $array = [
            count($mantenimiento),
            count($aprobacion),
            count($compras),
            count($permisos)
        ];
        
        $Totalpermisos = DB::select("SELECT * FROM tbl_sol_prm_laboral");
        $Totalpersonas = DB::select("SELECT * FROM tbl_personas");
        $Totalequipos = DB::select("SELECT * FROM tbl_inventario");
        $Totalcompras = DB::select("SELECT * FROM tbl_sol_compra");
        $Totalusers = DB::select("SELECT * FROM users");
        $Totalreparados = DB::select("SELECT * FROM tbl_dis_mantenimiento WHERE ESTATUS=3");

        $array2 = [
            count($Totalequipos), 
            count($Totalreparados),
            count($Totalpersonas),
            count($Totalpermisos),
            count($Totalcompras),
            count($Totalusers),
        ];

        return view('home', compact('array','array2'));
    }

}
