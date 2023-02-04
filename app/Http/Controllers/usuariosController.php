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
          $usuarios = User::where('id','<>',1)->get();
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
        $roles = Role::where('id','<>',1)->get();
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
        
                    //Validacion campos nulos
                    $validator = Validator::make($request->all(), [
                      'nombre_rol' => 'required',
                      'descripcion' => 'required',
                  ],[
                      'nombre_rol.required' => 'Debe ingresar el nombre del rol.',
                      'descripcion.required' => 'Debe ingresar la descripcion.',
                  ]);
          
                  if ($validator->fails()) {
                      return back()->withInput()
                                  ->withErrors($validator);            
                  }

                     //Validacion caracteres especiales
                     $validator = Validator::make($request->all(), [
                      'nombre_rol' => 'regex:/^[a-zA-Z\s]+$/u',
                      'descripcion' => 'regex:/^[a-zA-Z\s]+$/u',
                  ],[
                      'nombre_rol.regex' => 'Nombre del rol solo debe contener letras.',
                      'descripcion.regex' => 'Descripcion del rol solo debe contener letras.',
                  ]);
          
                  if ($validator->fails()) {
                      return back()->withInput()
                                  ->withErrors($validator);            
                  }

                      //Validacion caracteres especiales
                      $validator = Validator::make($request->all(), [
                        'nombre_rol' => 'max:20',
                        'descripcion' => 'max:50',
                    ],[
                        'nombre_rol.max' => 'Nombre del rol contiene demasiados caracteres.',
                        'descripcion.max' => 'Descripcion del rol contiene demasiados caracteres.',
                    ]);
            
                    if ($validator->fails()) {
                        return back()->withInput()
                                    ->withErrors($validator);            
                    }

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
        $permission = Permission::get();
        $permissionRole = DB::select("SELECT per.name, per.description,per.id, rol.role_id FROM permissions per INNER JOIN permission_role rol ON per.id=rol.permission_id WHERE rol.role_id=$id");
        $id=$request->id;
        $nombre =$name;
        return view('rolesEditar',compact('permission','permissionRole','id','nombre'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function intertPermission(Request $request,$id){
      if(Auth::user()->hasPermission('admin')){
        if($request->permiso==null){
          return back()->with('error','Debe seleccionar un permiso');
        }
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
        $roles = Role::get();
        $rolesUser = DB::Select("SELECT rol.description,rol.id,rol.name FROM roles rol INNER JOIN role_user roluser ON rol.id = roluser.role_id WHERE roluser.user_id = $id");
        $nombre=$name;
        $id=$request->id;
        return view('usuariosEditar',compact('usuario','roles','rolesUser','nombre','id'));
    }
    return back()->with('error','No tienes permisos');
    }

    public function insertRoleUser(Request $request,$id){
        if(Auth::user()->hasPermission('admin')){
          if($request->role==null){
            return back()->with('error','Debe seleccionar un rol');
          }
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
                              //Validacion campos nulos
                              $validator = Validator::make($request->all(), [
                                'name' => 'required',
                            ],[
                                'name.required' => 'Debe ingresar el nombre del usuario.',
                            ]);
                    
                            if ($validator->fails()) {
                                return back()->withInput()
                                            ->withErrors($validator);            
                            }
          
                               //Validacion caracteres especiales
                               $validator = Validator::make($request->all(), [
                                'name' => 'regex:/^[a-zA-Z\s]+$/u',
                            ],[
                                'name.regex' => 'Nombre del usuario solo debe contener letras.',
                            ]);
                    
                            if ($validator->fails()) {
                                return back()->withInput()
                                            ->withErrors($validator);            
                            }
          
                                //Validacion caracteres especiales
                                $validator = Validator::make($request->all(), [
                                  'name' => 'max:40',
                              ],[
                                  'name.max' => 'Nombre del usuario contiene demasiados caracteres.',
                              ]);
                      
                              if ($validator->fails()) {
                                  return back()->withInput()
                                              ->withErrors($validator);            
                              }
          
          if($request->password!=$request->password_confirm){
            return back()->withInput()->with('error','Las contraseñas no coinciden.');
          }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('getListaUsuarios')->with('mensaje','Usuario agregado exitosamente.');
    }
    return back()->with('error','No tienes permisos');
    }

    public function updatePasswordUser(Request $request,$id){
      if(Auth::user()->hasPermission('admin')){
        if($request->password!=$request->password_confirm){
          return back()->withInput()->with('error','Las contraseñas no coinciden.');
        }
      $user = User::find($id);
      $user->update([
        'password' => Hash::make($request->password)
      ]);

      return back()->with('mensaje','Contraseña actualizada exitosamente.');
    }
    return back()->with('error','No tienes permisos');
    }

    public function getCorreos(Request $request){
    if(Auth::user()->hasPermission('admin')){
          $data = Http::post('http://localhost:6000/correos/get',[
            'funcion' => 's'
          ]);
          $correos = $data->json();
          return view('correos',compact('correos'));
        }
        return back()->with('error','No tienes permisos');
    }

    public function getDatosCorreo(Request $request, $id){
    if(Auth::user()->hasPermission('admin')){
          $data = Http::post('http://localhost:6000/correos/search',[
            'funcion' => 'b',
            'cod_correo' => $id
          ]);
          $correo = $data->json();
          $correo = $correo[0];
          return view('correosEditar',compact('correo'));
        }
        return back()->with('error','No tienes permisos');
    }

    public function updateCorreo(Request $request, $id){
    if(Auth::user()->hasPermission('admin')){
      if($request->correo==null){
        return back()->with('error','Debe ingresar el correo');
      }
          Http::post('http://localhost:6000/correos/update',[
            'funcion' => 'u',
            'usr_adicion' => auth()->user()->name,
            'cod_correo' => $id,
            'correo' => $request->correo
          ]);
          
          return redirect()->route('getListaCorreos')->with('mensaje','Correo actualizado exitosamente.');
        }
         return back()->with('error','No tienes permisos');
    }
}
