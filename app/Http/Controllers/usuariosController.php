<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class usuariosController extends Controller
{
    public function getUsuarios(Request $request){
        $data = Http::post('http://localhost:6000/usuarios/get');
        $usuarios = $data->json();
        return view('usuarios',compact('usuarios'));
    }

    public function registroUsuarios(Request $request){
        return view('registro');
    }

    public function getRoles(Request $request){
        $data = Http::post('http://localhost:6000/roles/get');
        $roles = $data->json();
        return view('roles',compact('roles'));
    }

    public function nuevoRol(Request $request){
        return view('rolesNuevo');
    }

    
    public function insertRole(Request $request){
      Permission::create([
        'name' => $request->nombre_rol,
        'description' => $request->descripcion, // optional
        'created_at' => date('Y-m-d'), // optional
        ]);

        return back()->with('mensaje','Agregado exitosamente.');
    }

    public function getPermission(Request $request,$name,$id){
        $data = Http::post('http://localhost:6000/permission/get');
        $permission = $data->json();
        $dataDos = Http::post('http://localhost:6000/permissionRole/get',[
            'role_id' => $id
        ]);
        $permissionRole = $dataDos->json();
        $id=$request->id;
        $nombre =$name;
        return view('rolesEditar',compact('permission','permissionRole','id','nombre'));
    }

    public function intertPermission(Request $request,$id){
      $verificar = DB::connection('mysql')->table('permission_role')->where('permission_id','=',$request->permiso)->where('role_id','=',$id)->first();
      if($verificar==null){
         $role=Role::find($id);
         $role->attachPermission($request->permiso);;
         $id=$request->id;
         return back()->with('mensaje','Permiso asignado al rol');
      }else{
        return back()->with('error','El rol ya tiene asignado este permiso');
      }
    }

    public function insertEquipo(Request $request){

        $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'required',
            'marca_equipo' => 'required',
            'modelo_serie' => 'required',
            'especificaciones' => 'required',
            'color_equipo' => 'required',
            'numero_equipo' => 'required',
            'fecha_ingreso' => 'required',

        ],[
            'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
            'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
            'modelo_Serie.required' => 'Debe ingresar el modelo/serie del equipo.',
            'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'color_equipo.required' => 'Debe ingresar el color del equipo.',
            'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);            
        }

        HTTP::post('http://localhost:6000/inventario/insert',[
            'funcion' => 'i',
            'usr_adicion' => auth()->user()->name,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);

        $inventario = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventarioLista',compact('equipos'));

    }

    public function deleteEquipo(Request $request,$id){
        $inventario = Http::post('http://localhost:6000/inventario/delete', [
            'funcion' => 'd',
            'cod_equipo' => $id,
        ]);

        $inventario = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return view('inventarioLista',compact('equipos'));

    }

    public function getDatosEquipo(Request $request, $id){
        $datos = HTTP::post('http://localhost:6000/inventario/search',[
            'funcion' => 'b',
            'cod_equipo' => $id,
        ]);
        $equipo = $datos->json();
        $equipo = $equipo[0];
        return view('inventarioEditar',compact('equipo'));
    }

    public function updateDatosEquipo(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'tipo_equipo' => 'required',
            'marca_equipo' => 'required',
            'modelo_serie' => 'required',
            'especificaciones' => 'required',
            'color_equipo' => 'required',
            'numero_equipo' => 'required',
            'fecha_ingreso' => 'required',

        ],[
            'tipo_equipo.required' => 'Debe ingresar el tipo de equipo.',
            'marca_equipo.required' => 'Debe ingresar la marca del equipo.',
            'modelo_Serie.required' => 'Debe ingresar el modelo/serie del equipo.',
            'especificaciones.required' => 'Debe ingresar las especificaciones tecnicas del equipo.',
            'color_equipo.required' => 'Debe ingresar el color del equipo.',
            'numero_equipo.required' => 'Debe ingresar el numero del equipo.',
            'fecha_ingreso.required' => 'Debe ingresar la fecha de ingreso del equipo.',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                        ->withErrors($validator);
                        
        }

        HTTP::post('http://localhost:6000/inventario/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_equipo' => $id,
            'tip_equipo' => $request->tipo_equipo,
            'mrc_equipo' => $request->marca_equipo,
            'mdl_serie' => $request->modelo_serie,
            'ecf_tecnicas' => $request->especificaciones,
            'clr_equipo' => $request->color_equipo,
            'num_equipo' => $request->numero_equipo,
            'fec_ingreso' => $request->fecha_ingreso
        ]);
        $inventario = Http::post('http://localhost:6000/inventario/get', [
            'funcion' => 's',
        ]);
        $equipos = $inventario->json();
        return back()->with('mensaje','Actualizacion exitosa.');
    }
}
