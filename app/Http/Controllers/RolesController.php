<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests\RoleCreateRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; #ruta directa de donde se encuentra el modelo de permisos 
use App\User;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function index(){
        $role = Role::orderBy('id')->paginate(8);
        $usuario = new User();
        $permisos = new Permission();
        return view('roles.index',compact('role', 'usuario', 'permisos'));
    }

    public function getRoles(){
        $roles = Roles::getRoles();
        return response()->json(['roles'=> $roles],200);
    }

    public function store(RoleCreateRequest $request){
        
        
        $nuevoRole = Role::create([
            'name' => $request->input('nombre'),
            'description' => $request->input('descripcion'),
            ]);
        if($nuevoRole->id){
            return redirect('roles')->with('flash','rol creado exitosamente '); //quisiera enviar notificasiones touster o flash no se como se llaman   
        }else{
            return Redirect::back()->withErrors(['msg', 'No se pudo guardar el role error: ERR-M-RL-01']);
        }
    }
    
    public function show($id){
        if ( !Auth::user()->hasPermissionTo('roles.edit') ){
            $rol = Role::find($id) ;
            $permisos = Permission::all() ;
            return view('roles.view',compact('rol','permisos'));
        }else{
            $rol = Role::find($id) ;
            $permisos = Permission::all() ;
            return view('roles.edit',compact('rol','permisos'));
        }
    }
    
    public function update(RoleUpdateRequest $request,$role_id ){
        $role = Role::find($role_id);
        $role->description = $request->input('descripcion');
        $role->save();
        return redirect()->route('roles.edit', ['role' => $role_id])->with('flash','Rol actualizado.');
    }
    
    public function edit($id){
        //checar si tiene permiso
        $rol = Role::find($id);
        $permisos = Permission::all();
        return view('roles.edit',compact('rol','permisos'));
    }
    
    public function destroy($role_id){
        $role = Role::find($role_id);
        $role->delete();
        return redirect('roles')->with('flash','Rol ELIMINADO Exitosamente ');;
    }
    
    public function editPermissions(Request $request, $role_id){
       $role=Role::find($role_id);
       $role->syncPermissions($request->input('permisos'));
       return redirect()->route('roles.edit', ['role' => $role_id])->with('flash','Permisos del rol actualizados');
    }
}
