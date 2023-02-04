<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Exports\inventario;
use App\Exports\permisos;
use App\Exports\compras;
use App\Exports\reparados;
use App\Exports\personas;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class reportesController extends Controller
{
    public function getInventario(Request $request){
        if(Auth::user()->hasPermission('inventario')){
        $data = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $data->json();
        return view('inventarioListaReporte',compact('equipos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function reporteInventarioPDF(Request $request){
    if(Auth::user()->hasPermission('inventario-reporte')){

         //Validacion de caracteres especiales
         $validator = Validator::make($request->all(), [
            'fecha_desde' => 'required',
            'fecha_hasta' => 'required',
        ],[
            'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
            'fecha_hasta.required' => 'Debe ingresar una fecha final.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }
                //Validacion de caracteres especiales
         $validator = Validator::make($request->all(), [
             'fecha_desde' => 'required|date|after:2000-01-01',
             'fecha_hasta' => 'required|date|after:2000-01-01',
         ],[
             'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
             'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
         ]);
        
         if ($validator->fails()) {
             return back()->withInput()
                         ->withErrors($validator);            
         }
         
           //Validacion de cantidadad de caracteres
           $validator = Validator::make($request->all(), [
             'fecha_desde' => 'before:01/01/2050',
             'fecha_hasta' => 'before:01/01/2050',

         ],[
             'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
             'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
         ]);

         if ($validator->fails()) {
             return back()->withInput()
                         ->withErrors($validator);            
         }

        $pieces = explode("-", $request->fecha_desde);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha de inicio valida');
                        
        }

        $pieces = explode("-", $request->fecha_hasta);
        if (strlen($pieces[0])>4) {
            return back()->withInput()
                        ->with('error','Ingrese una fecha final valida');
                        
        }

        if ($request->fecha_desde>$request->fecha_hasta) {
            return back()->withInput()
                        ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
        }


        $fecha_desde = $request->fecha_desde;
        $fecha_hasta = $request->fecha_hasta;

        $cmd="SELECT TIP_EQUIPO, MRC_EQUIPO, MDL_SERIE, ECF_TECNICAS,
        CLR_EQUIPO, NUM_EQUIPO, FEC_INGRESO, NUM_EQUIPO FROM inventario 
        WHERE FEC_INGRESO>='".$fecha_desde."' AND FEC_INGRESO<='".$fecha_hasta."'";

        $equipos = DB::select($cmd);
        if($equipos==null){
            return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
        }

        $pdf = Pdf::loadView('reporteInventario',compact('equipos'));
        return $pdf->download('Reporte de inventario.pdf');
    }
    return back()->with('error','No tienes permisos');
    }

    public function reporteInventarioEXCEL(Request $request){
        if(Auth::user()->hasPermission('inventario-reporte')){
    
             //Validacion de caracteres especiales
             $validator = Validator::make($request->all(), [
                'fecha_desde' => 'required',
                'fecha_hasta' => 'required',
            ],[
                'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                'fecha_hasta.required' => 'Debe ingresar una fecha final.',
            ]);
    
            if ($validator->fails()) {
                return back()->withInput()
                            ->withErrors($validator);            
            }
                    //Validacion de caracteres especiales
                    $validator = Validator::make($request->all(), [
                        'fecha_desde' => 'required|date|after:2000-01-01',
                        'fecha_hasta' => 'required|date|after:2000-01-01',
                    ],[
                        'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                        'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                    ]);
            
                    if ($validator->fails()) {
                        return back()->withInput()
                                    ->withErrors($validator);            
                    }
                      //Validacion de cantidadad de caracteres
                      $validator = Validator::make($request->all(), [
                        'fecha_desde' => 'before:01/01/2050',
                        'fecha_hasta' => 'before:01/01/2050',
    
                    ],[
                        'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                        'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                    ]);
    
                    if ($validator->fails()) {
                        return back()->withInput()
                                    ->withErrors($validator);            
                    }

                    $pieces = explode("-", $request->fecha_desde);
                    if (strlen($pieces[0])>4) {
                        return back()->withInput()
                                    ->with('error','Ingrese una fecha de inicio valida');
                                    
                    }
            
                    $pieces = explode("-", $request->fecha_hasta);
                    if (strlen($pieces[0])>4) {
                        return back()->withInput()
                                    ->with('error','Ingrese una fecha final valida');
                                    
                    }
            
                    if ($request->fecha_desde>$request->fecha_hasta) {
                        return back()->withInput()
                                    ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                    }
    
            $fecha_desde = $request->fecha_desde;
            $fecha_hasta = $request->fecha_hasta;
    
            
            $equipos = DB::table('inventario')
            ->select('TIP_EQUIPO','MRC_EQUIPO','MDL_SERIE','ECF_TECNICAS','CLR_EQUIPO','NUM_EQUIPO','FEC_INGRESO')
            ->where('FEC_INGRESO','>=',$fecha_desde)
            ->where('FEC_INGRESO','<=',$fecha_hasta)->get();
  
            if(count($equipos)==0){
                return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
            }
           
            return Excel::download(new inventario($equipos), 'Reporte de inventario.xlsx');

        }
        return back()->with('error','No tienes permisos');
        }

        public function getPermisos(Request $request){
            if(Auth::user()->hasPermission('permisos')){
                $data = Http::post('http://localhost:6000/permiso/get', [
                    'funcion' => 's',
                ]);
                $permisos = $data->json();
                $permisos = $permisos[0];
                return view('spermisoListaReporte',compact('permisos'));
            }
            return back()->with('error','No tienes permisos');
            }

            public function reportePermisoPDF(Request $request){
                if(Auth::user()->hasPermission('permisos-reporte')){
            
                     //Validacion de caracteres especiales
                     $validator = Validator::make($request->all(), [
                        'fecha_desde' => 'required',
                        'fecha_hasta' => 'required',
                    ],[
                        'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                        'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                    ]);
            
                    if ($validator->fails()) {
                        return back()->withInput()
                                    ->withErrors($validator);            
                    }
                            //Validacion de caracteres especiales
                            $validator = Validator::make($request->all(), [
                                'fecha_desde' => 'required|date|after:2000-01-01',
                                'fecha_hasta' => 'required|date|after:2000-01-01',
                            ],[
                                'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                            ]);
                    
                            if ($validator->fails()) {
                                return back()->withInput()
                                            ->withErrors($validator);            
                            }
                              //Validacion de cantidadad de caracteres
                              $validator = Validator::make($request->all(), [
                                'fecha_desde' => 'before:01/01/2050',
                                'fecha_hasta' => 'before:01/01/2050',
            
                            ],[
                                'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                            ]);
            
                            if ($validator->fails()) {
                                return back()->withInput()
                                            ->withErrors($validator);            
                            }

                            $pieces = explode("-", $request->fecha_desde);
                            if (strlen($pieces[0])>4) {
                                return back()->withInput()
                                            ->with('error','Ingrese una fecha de inicio valida');
                                            
                            }
                    
                            $pieces = explode("-", $request->fecha_hasta);
                            if (strlen($pieces[0])>4) {
                                return back()->withInput()
                                            ->with('error','Ingrese una fecha final valida');
                                            
                            }
                    
                            if ($request->fecha_desde>$request->fecha_hasta) {
                                return back()->withInput()
                                            ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                            }
            
                    $fecha_desde = $request->fecha_desde;
                    $fecha_hasta = $request->fecha_hasta;
            
                    $cmd="SELECT SOL.TIP_SOLICITUD, SOL.DES_SOLICITUD, SOL.FEC_SOLICITUD, SOL.FEC_INICIO, SOL.FEC_FINAL, SOL.IND_SOLICITUD, 
                    CONCAT(PER.NOM_PERSONA,' ',PER.APLL_PERSONA) AS PERSONA FROM sol_prm_laboral SOL
                    INNER JOIN personas PER on SOL.COD_PERSONA = PER.COD_PERSONA
                    WHERE SOL.FEC_SOLICITUD>='".$fecha_desde."' AND SOL.FEC_SOLICITUD<='".$fecha_hasta."'";
            
                    $permisos = DB::select($cmd);
                    if($permisos==null){
                        return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                    }
            
                    $pdf = Pdf::loadView('reportePermisos',compact('permisos'));
                    return $pdf->download('Reporte de permisos laborales.pdf');
                }
                return back()->with('error','No tienes permisos');
                }
            
                public function reportePermisoEXCEL(Request $request){
                    if(Auth::user()->hasPermission('permisos-reporte')){
                
                         //Validacion de caracteres especiales
                         $validator = Validator::make($request->all(), [
                            'fecha_desde' => 'required',
                            'fecha_hasta' => 'required',
                        ],[
                            'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                            'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                        ]);
                
                        if ($validator->fails()) {
                            return back()->withInput()
                                        ->withErrors($validator);            
                        }
                                //Validacion de caracteres especiales
                                $validator = Validator::make($request->all(), [
                                    'fecha_desde' => 'required|date|after:2000-01-01',
                                    'fecha_hasta' => 'required|date|after:2000-01-01',
                                ],[
                                    'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                    'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                                ]);
                        
                                if ($validator->fails()) {
                                    return back()->withInput()
                                                ->withErrors($validator);            
                                }
                                  //Validacion de cantidadad de caracteres
                                  $validator = Validator::make($request->all(), [
                                    'fecha_desde' => 'before:01/01/2050',
                                    'fecha_hasta' => 'before:01/01/2050',
                
                                ],[
                                    'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                    'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                                ]);
                
                                if ($validator->fails()) {
                                    return back()->withInput()
                                                ->withErrors($validator);            
                                }

                                $pieces = explode("-", $request->fecha_desde);
                                if (strlen($pieces[0])>4) {
                                    return back()->withInput()
                                                ->with('error','Ingrese una fecha de inicio valida');
                                                
                                }
                        
                                $pieces = explode("-", $request->fecha_hasta);
                                if (strlen($pieces[0])>4) {
                                    return back()->withInput()
                                                ->with('error','Ingrese una fecha final valida');
                                                
                                }
                        
                                if ($request->fecha_desde>$request->fecha_hasta) {
                                    return back()->withInput()
                                                ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                                }
                
                        $fecha_desde = $request->fecha_desde;
                        $fecha_hasta = $request->fecha_hasta;
                
                       $permisos = DB::table('sol_prm_laboral')
                       ->join('personas', 'sol_prm_laboral.cod_persona', '=', 'personas.cod_persona')
                       ->select('personas.NOM_PERSONA','personas.APLL_PERSONA','sol_prm_laboral.TIP_SOLICITUD','sol_prm_laboral.FEC_SOLICITUD','sol_prm_laboral.FEC_INICIO','sol_prm_laboral.FEC_FINAL','sol_prm_laboral.IND_SOLICITUD')
                       ->where('sol_prm_laboral.FEC_SOLICITUD','>=',$fecha_desde)
                       ->where('sol_prm_laboral.FEC_SOLICITUD','<=',$fecha_hasta)
                       ->get();

                        if(count($permisos)==0){
                            return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                        }
                        
                        return Excel::download(new permisos($permisos), 'Reporte de permisos.xlsx');
                    }
                    return back()->with('error','No tienes permisos');
                    }

                    public function getCompras (Request $request){
                        if(Auth::user()->hasPermission('compras')){
                            $data = Http::post('http://localhost:6000/compra/get', [
                                'funcion' => 's',
                            ]);
                            $compras = $data->json();
                            return view('scompraListaReporte',compact('compras'));
                        }
                        return back()->with('error','No tienes permisos');
                        }

                        public function reportecomprasPDF(Request $request){
                            if(Auth::user()->hasPermission('compras-reporte')){
                        
                                 //Validacion de caracteres especiales
                                 $validator = Validator::make($request->all(), [
                                    'fecha_desde' => 'required',
                                    'fecha_hasta' => 'required',
                                ],[
                                    'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                                    'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                                ]);
                        
                                if ($validator->fails()) {
                                    return back()->withInput()
                                                ->withErrors($validator);            
                                }
                                        //Validacion de caracteres especiales
                                        $validator = Validator::make($request->all(), [
                                            'fecha_desde' => 'required|date|after:2000-01-01',
                                            'fecha_hasta' => 'required|date|after:2000-01-01',
                                        ],[
                                            'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                            'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                                        ]);
                                
                                        if ($validator->fails()) {
                                            return back()->withInput()
                                                        ->withErrors($validator);            
                                        }
                                          //Validacion de cantidadad de caracteres
                                          $validator = Validator::make($request->all(), [
                                            'fecha_desde' => 'before:01/01/2050',
                                            'fecha_hasta' => 'before:01/01/2050',
                        
                                        ],[
                                            'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                            'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                                        ]);
                        
                                        if ($validator->fails()) {
                                            return back()->withInput()
                                                        ->withErrors($validator);            
                                        }

                                        $pieces = explode("-", $request->fecha_desde);
                                        if (strlen($pieces[0])>4) {
                                            return back()->withInput()
                                                        ->with('error','Ingrese una fecha de inicio valida');
                                                        
                                        }
                                
                                        $pieces = explode("-", $request->fecha_hasta);
                                        if (strlen($pieces[0])>4) {
                                            return back()->withInput()
                                                        ->with('error','Ingrese una fecha final valida');
                                                        
                                        }
                                
                                        if ($request->fecha_desde>$request->fecha_hasta) {
                                            return back()->withInput()
                                                        ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                                        }
                        
                                $fecha_desde = $request->fecha_desde;
                                $fecha_hasta = $request->fecha_hasta;
                        
                                $cmd="SELECT SOL.FEC_SOLICITUD, SOL.DES_SOLICITUD, SOL.IND_SOLICITUD, EQU.NUM_EQUIPO FROM sol_compra SOL
                                INNER JOIN dis_mantenimiento MAN ON SOL.COD_REPARACION = MAN.COD_REPARACION
                                INNER JOIN inventario EQU on MAN.COD_EQUIPO = EQU.COD_EQUIPO
                                WHERE SOL.FEC_SOLICITUD>='".$fecha_desde."' AND SOL.FEC_SOLICITUD<='".$fecha_hasta."'";
                        
                                $compras = DB::select($cmd);
                                if($compras==null){
                                    return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                }
                        
                                $pdf = Pdf::loadView('reporteCompras',compact('compras'));
                                return $pdf->download('Reporte de solicitudes de compras.pdf');
                            }
                            return back()->with('error','No tienes permisos');
                            }
                        
                            public function reportecomprasEXCEL(Request $request){
                                if(Auth::user()->hasPermission('compras-reporte')){
                            
                                     //Validacion de caracteres especiales
                                     $validator = Validator::make($request->all(), [
                                        'fecha_desde' => 'required',
                                        'fecha_hasta' => 'required',
                                    ],[
                                        'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                                        'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                                    ]);
                            
                                    if ($validator->fails()) {
                                        return back()->withInput()
                                                    ->withErrors($validator);            
                                    }
                                            //Validacion de caracteres especiales
                                            $validator = Validator::make($request->all(), [
                                                'fecha_desde' => 'required|date|after:2000-01-01',
                                                'fecha_hasta' => 'required|date|after:2000-01-01',
                                            ],[
                                                'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                                'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                                            ]);
                                    
                                            if ($validator->fails()) {
                                                return back()->withInput()
                                                            ->withErrors($validator);            
                                            }
                                              //Validacion de cantidadad de caracteres
                                              $validator = Validator::make($request->all(), [
                                                'fecha_desde' => 'before:01/01/2050',
                                                'fecha_hasta' => 'before:01/01/2050',
                            
                                            ],[
                                                'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                                'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                                            ]);
                            
                                            if ($validator->fails()) {
                                                return back()->withInput()
                                                            ->withErrors($validator);            
                                            }

                                            $pieces = explode("-", $request->fecha_desde);
                                            if (strlen($pieces[0])>4) {
                                                return back()->withInput()
                                                            ->with('error','Ingrese una fecha de inicio valida');
                                                            
                                            }
                                    
                                            $pieces = explode("-", $request->fecha_hasta);
                                            if (strlen($pieces[0])>4) {
                                                return back()->withInput()
                                                            ->with('error','Ingrese una fecha final valida');
                                                            
                                            }
                                    
                                            if ($request->fecha_desde>$request->fecha_hasta) {
                                                return back()->withInput()
                                                            ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                                            }
                            
                                    $fecha_desde = $request->fecha_desde;
                                    $fecha_hasta = $request->fecha_hasta;
                            
                                   $compras = DB::table('sol_compra')
                                  ->join('dis_mantenimiento', 'sol_compra.cod_reparacion', '=', 'dis_mantenimiento.cod_reparacion')
                                  ->join('inventario', 'dis_mantenimiento.cod_equipo', '=', 'inventario.cod_equipo')
                                  ->select('inventario.NUM_EQUIPO','sol_compra.DES_SOLICITUD','sol_compra.FEC_SOLICITUD','sol_compra.IND_SOLICITUD')
                                  ->where('sol_compra.FEC_SOLICITUD','>=',$fecha_desde)
                                  ->where('sol_compra.FEC_SOLICITUD','<=',$fecha_hasta)
                                  ->get();

                                    if(count($compras)==0){
                                        return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                    }
                                    
                                    return Excel::download(new compras($compras), 'Reporte de solicitudes de compra.xlsx');
                                }
                                return back()->with('error','No tienes permisos');
                                }

                                public function reporteReparadosPDF(Request $request){
                                    if(Auth::user()->hasPermission('mantenimiento-reporte')){
                                
                                         //Validacion de caracteres especiales
                                         $validator = Validator::make($request->all(), [
                                            'fecha_desde' => 'required',
                                            'fecha_hasta' => 'required',
                                        ],[
                                            'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                                            'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                                        ]);
                                
                                        if ($validator->fails()) {
                                            return back()->withInput()
                                                        ->withErrors($validator);            
                                        }
                                                //Validacion de caracteres especiales
                                                $validator = Validator::make($request->all(), [
                                                    'fecha_desde' => 'required|date|after:2000-01-01',
                                                    'fecha_hasta' => 'required|date|after:2000-01-01',
                                                ],[
                                                    'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                                    'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                                                ]);
                                        
                                                if ($validator->fails()) {
                                                    return back()->withInput()
                                                                ->withErrors($validator);            
                                                }
                                                  //Validacion de cantidadad de caracteres
                                                  $validator = Validator::make($request->all(), [
                                                    'fecha_desde' => 'before:01/01/2050',
                                                    'fecha_hasta' => 'before:01/01/2050',
                                
                                                ],[
                                                    'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                                    'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                                                ]);
                                
                                                if ($validator->fails()) {
                                                    return back()->withInput()
                                                                ->withErrors($validator);            
                                                }

                                                $pieces = explode("-", $request->fecha_desde);
                                                if (strlen($pieces[0])>4) {
                                                    return back()->withInput()
                                                                ->with('error','Ingrese una fecha de inicio valida');
                                                                
                                                }
                                        
                                                $pieces = explode("-", $request->fecha_hasta);
                                                if (strlen($pieces[0])>4) {
                                                    return back()->withInput()
                                                                ->with('error','Ingrese una fecha final valida');
                                                                
                                                }
                                        
                                                if ($request->fecha_desde>$request->fecha_hasta) {
                                                    return back()->withInput()
                                                                ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                                                }
                                
                                        $fecha_desde = $request->fecha_desde;
                                        $fecha_hasta = $request->fecha_hasta;
                                
                                        $cmd="SELECT INV.TIP_EQUIPO, INV.MRC_EQUIPO, INV.MDL_SERIE,
                                        INV.NUM_EQUIPO, INV.FEC_INGRESO, INV.NUM_EQUIPO, MAN.FEC_INGRESO, MAN.FEC_SALIDA FROM dis_mantenimiento MAN
                                        INNER JOIN inventario INV ON MAN.COD_EQUIPO = INV.COD_EQUIPO
                                        WHERE MAN.FEC_INGRESO>='".$fecha_desde."' AND MAN.FEC_INGRESO<='".$fecha_hasta."' AND MAN.ESTATUS=3";
                                
                                        $equipos = DB::select($cmd);
                                        if($equipos==null){
                                            return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                        }
                                
                                        $pdf = Pdf::loadView('reporteReparados',compact('equipos'));
                                        return $pdf->download('Reporte de equipos reparados.pdf');
                                    }
                                    return back()->with('error','No tienes permisos');
                                    }
                                
                                    public function reporteReparadosEXCEL(Request $request){
                                        if(Auth::user()->hasPermission('mantenimiento-reporte')){
                                    
                                             //Validacion de caracteres especiales
                                             $validator = Validator::make($request->all(), [
                                                'fecha_desde' => 'required',
                                                'fecha_hasta' => 'required',
                                            ],[
                                                'fecha_desde.required' => 'Debe ingresar una fecha de inicio.',
                                                'fecha_hasta.required' => 'Debe ingresar una fecha final.',
                                            ]);
                                    
                                            if ($validator->fails()) {
                                                return back()->withInput()
                                                            ->withErrors($validator);            
                                            }
                                                    //Validacion de caracteres especiales
                                                    $validator = Validator::make($request->all(), [
                                                        'fecha_desde' => 'required|date|after:2000-01-01',
                                                        'fecha_hasta' => 'required|date|after:2000-01-01',
                                                    ],[
                                                        'fecha_desde.after' => 'Debe ingresar una fecha de inicio valida.',
                                                        'fecha_hasta.after' => 'Debe ingresar una fecha final valida.',
                                                    ]);
                                            
                                                    if ($validator->fails()) {
                                                        return back()->withInput()
                                                                    ->withErrors($validator);            
                                                    }
                                                      //Validacion de cantidadad de caracteres
                                                      $validator = Validator::make($request->all(), [
                                                        'fecha_desde' => 'before:01/01/2050',
                                                        'fecha_hasta' => 'before:01/01/2050',
                                    
                                                    ],[
                                                        'fecha_desde.before' => 'Debe ingresar una fecha de inicio valida.',
                                                        'fecha_hasta.before' => 'Debe ingresar una fecha final valida.',
                                                    ]);
                                    
                                                    if ($validator->fails()) {
                                                        return back()->withInput()
                                                                    ->withErrors($validator);            
                                                    }

                                                    $pieces = explode("-", $request->fecha_desde);
                                                    if (strlen($pieces[0])>4) {
                                                        return back()->withInput()
                                                                    ->with('error','Ingrese una fecha de inicio valida');
                                                                    
                                                    }
                                            
                                                    $pieces = explode("-", $request->fecha_hasta);
                                                    if (strlen($pieces[0])>4) {
                                                        return back()->withInput()
                                                                    ->with('error','Ingrese una fecha final valida');
                                                                    
                                                    }
                                            
                                                    if ($request->fecha_desde>$request->fecha_hasta) {
                                                        return back()->withInput()
                                                                    ->with('error','La fecha de inicio no puede ser mayor a la fecha final');             
                                                    }
                                    
                                            $fecha_desde = $request->fecha_desde;
                                            $fecha_hasta = $request->fecha_hasta;
                                    
                                              $equipos = DB::table('dis_mantenimiento')
                                              ->join('inventario', 'dis_mantenimiento.cod_equipo', '=', 'inventario.cod_equipo')
                                              ->select('inventario.TIP_EQUIPO','inventario.MRC_EQUIPO','inventario.MDL_SERIE','inventario.NUM_EQUIPO','dis_mantenimiento.FEC_INGRESO','dis_mantenimiento.FEC_SALIDA')
                                              ->where('dis_mantenimiento.ESTATUS','=','3')
                                              ->where('dis_mantenimiento.FEC_SALIDA','>=',$fecha_desde)
                                              ->where('dis_mantenimiento.FEC_SALIDA','<=',$fecha_hasta)
                                              ->get();

                                            if(count($equipos)==0){
                                                return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                            }
                                            
                                            return Excel::download(new reparados($equipos), 'Reporte de equipos reparados.xlsx');
                                        }
                                        return back()->with('error','No tienes permisos');
                                        }
        
                                        public function getpersonas(Request $request){
                                            if(Auth::user()->hasPermission('personas')){
                                        
                                                $data = HTTP::post('http://localhost:6000/persona/get',[
                                                    'funcion' => 's',
                                                ]);
                                                $personas = $data->json();
                                                return view('personaReporte',compact('personas'));
                                            }
                                            return back()->with('error','No tienes permisos');
                                            }

                                            public function reportepersonasPDF(Request $request){
                                                if(Auth::user()->hasPermission('inventario')){    
                                                    $cmd="SELECT NOM_PERSONA, ROL_PERSONA, APLL_PERSONA, NUM_IDENTIDAD, FEC_NACIMIENTO, DES_REF_PERSONA, NUM_REF_PERSONA, COR_PERSONA FROM personas";
                                            
                                                    $personas = DB::select($cmd);
                                                    if($personas==null){
                                                        return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                                    }
                                            
                                                    $pdf = Pdf::loadView('reportePersonas',compact('personas'));
                                                    return $pdf->download('Reporte de personas.pdf');
                                                }
                                                return back()->with('error','No tienes permisos');
                                                }
                                            
                                                public function reportepersonasEXCEL(Request $request){
                                                    if(Auth::user()->hasPermission('inventario')){
                                                
                                                        $personas = DB::table('personas')->select('nom_persona', 'apll_persona', 'rol_persona', 'num_identidad', 'fec_nacimiento', 'des_ref_persona', 'num_ref_persona', 'cor_persona')->get();                                            
                                                        if(count($personas)==0){
                                                            return back()->withInput()->with('error','Cero valores encontrados para generar reporte');
                                                        }

                                                        return Excel::download(new personas($personas), 'Reporte de personas.xlsx');
                                                    }
                                                    return back()->with('error','No tienes permisos');
                                                    }
                                                }