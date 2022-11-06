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
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    public function getUsuarios(Request $request){
        if(Auth::user()->hasPermission('admin')){
          $data = Http::post('http://localhost:6000/usuarios/get');
          $usuarios = $data->json();
          return view('usuarios',compact('usuarios'));
        }
        return back()->with('error','No tienes permisos');
    }

    public function registroUsuarios(Request $request){
        if(Auth::user()->hasPermission('admin')){
        return view('registro');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getRoles(Request $request){
        if(Auth::user()->hasPermission('admin')){
        $data = Http::post('http://localhost:6000/roles/get');
        $roles = $data->json();
        return view('roles',compact('roles'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function nuevoRol(Request $request){
        if(Auth::user()->hasPermission('admin')){
        return view('rolesNuevo');
    }
    return back()->with('error','No tienes permisos');
    }

    
    public function insertRole(Request $request){
        if(Auth::user()->hasPermission('admin')){
        Role::create([
        'name' => $request->nombre_rol,
        'description' => $request->descripcion, // optional
        'created_at' => date('Y-m-d'), // optional
        ]);
        return redirect()->route('getListaRoles')->with('mensaje','Rol agregado exitosamente.');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getPermission(Request $request,$name,$id){
        if(Auth::user()->hasPermission('admin')){
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
    return back()->with('error','No tienes permisos');
    }

    public function intertPermission(Request $request,$id){
      if(Auth::user()->hasPermission('admin')){
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
    return back()->with('error','No tienes permisos');
    }

    public function getDatosUsuario(Request $request,$name,$id){
        if(Auth::user()->hasPermission('admin')){
        $usuario = User::find($id);
        $data = Http::post('http://localhost:6000/rolesUser/get',[
            'user_id' => $id
        ]);
        $roles=Role::select('*')->get();
        $nombre=$name;
        $id=$request->id;
        $rolesUser = $data->json();
        return view('usuariosEditar',compact('usuario','roles','rolesUser','nombre','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertRoleUser(Request $request,$id){
        if(Auth::user()->hasPermission('admin')){
        $verificar = DB::connection('mysql')->table('role_user')->where('role_id','=',$request->role)->where('user_id','=',$id)->first();
        if($verificar==null){
           $user=User::find($id);
           $user->attachRole($request->role);;
           return back()->with('mensaje','Rol asignado al usuario');
        }else{
          return back()->with('error','El usuario ya tiene este rol asignado');
        }
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteRole(Request $request,$id){
        if(Auth::user()->hasPermission('admin')){
        $role = Role::find($id);
        $role->delete();
        return back()->with('mensaje','Rol eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function deleteUser(Request $request,$id){
        if(Auth::user()->hasPermission('admin')){
        $user = User::find($id);
        $user->delete();
        return back()->with('mensaje','Usuario eliminado exitosamente');
    }
    return back()->with('error','No tienes permisos');
    }

    public function createUser(Request $request){
        if(Auth::user()->hasPermission('admin')){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('getListaUsuarios')->with('mensaje','Usuario agregado exitosamente.');
    }
    return back()->with('error','No tienes permisos');
    }
}
