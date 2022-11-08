<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class mantenimientoController extends Controller
{
    public function getMantenimiento(Request $request){
        if(Auth::user()->hasPermission('mantenimiento')){
        $data = HTTP::post('http://localhost:6000/mantenimiento/get',[
            'funcion' => 's'
        ]);
        $equipos = $data->json();
        $equipos = $equipos[0];
        $equipos[0]['FEC_INGRESO']=date("Y-m-d", strtotime($equipos[0]['FEC_INGRESO']));
        return view('mantenimientoLista',compact('equipos'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function getDatosMantenimiento(Request $request,$id){
        if(Auth::user()->hasPermission('mantenimiento-editar')){
        $data = HTTP::post('http://localhost:6000/mantenimiento/search',[
            'funcion' => 'b',
            'cod_reparacion' => $id,
        ]);
        $equipo = $data->json();
        $equipo = $equipo[0];
        $dataDos = HTTP::post('http://localhost:6000/persona/get',[
            'funcion' => 's',
        ]);
        $personas = $dataDos->json();
        $personas = $personas[0];

        $dataTres = HTTP::post('http://localhost:6000/solicitud/search',[
            'funcion' => 'b',
            'cod_sol_mantenimiento' =>$equipo[0]['COD_SOL_MANTENIMIENTO']
        ]);
        $solicitud = $dataTres->json();
        $solicitud = $solicitud[0];
        $id = $id;
        $equipo[0]['FEC_INGRESO']=date("Y-m-d", strtotime($equipo[0]['FEC_INGRESO']));
        $equipo[0]['FEC_SALIDA']=date("Y-m-d", strtotime($equipo[0]['FEC_SALIDA']));
        return view('mantenimientoEditar',compact('equipo','personas','solicitud','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function updateMantenimiento(Request $request,$id,$sol,$eq){
        if(Auth::user()->hasPermission('mantenimiento-editar')){
        $validator = Validator::make($request->all(), [
            'descripcion_falla' => 'required',
            'estado_equipo' => 'required',
        ],[
            'descripcion_falla.required' => 'Debe ingresar el tipo de equipo.',
            'estado_equipo.required' => 'Debe ingresar la marca del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);               
        }

        HTTP::post('http://localhost:6000/mantenimiento/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_reparacion' => $id,
            'cod_equipo' => $eq,
            'cod_persona' => $request->cod_persona,
            'cod_sol_mantenimiento' => $sol,
            'des_falla' => $request->descripcion_falla,
            'sol_problema' => $request->solucion_problema,
            'est_equipo' => $request->estado_equipo,
            'fec_ingreso' => $request->fecha_ingreso,
            'fec_salida' => $request->fecha_salida
        ]);
        return redirect()->route('getListaMantenimiento')->with('mensaje','Actualizado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    } 

    public function deleteMantenimiento(Request $request,$id){
        if(Auth::user()->hasPermission('mantenimiento-eliminar')){
        Http::post('http://localhost:6000/mantenimiento/delete', [
            'funcion' => 'd',
            'cod_reparacion' => $id,
        ]);
        return back()->with('mensaje','Eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }
}