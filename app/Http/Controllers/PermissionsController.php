<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; #ruta directa de donde se encuentra el modelo de permisos
use Spatie\Permission\Models\Role; 
use App\User;
use App\Http\Requests\PermissionCreateRequest;
use  Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        $permisos = Permission::paginate(8);
        $usuario = new User();
        $role = new Role();
        return view('permissions.index',compact('permisos','usuario','role'));
    }
    
    public function create(){
        //esta desactivado ya que se hace via modal
        abort(403, 'Esta acción no está permitida.');
    }
    
    public function store(PermissionCreateRequest $request ){
        $nuevoPermiso = Permission::create([
            'name' => $request->input('name'), 
            'nameToShow'=>$request->input('nombre_para_mostrar'), 
            'description' => $request->input('description')
            ]);
        if($nuevoPermiso->id){
            return redirect('permissions')->with('flash','permiso CREADO Exitosamente '); //quisiera enviar notificasiones touster o flash no se como se llaman 
        }else{
            return Redirect::back()->withErrors(['msg', 'No se pudo guardar el permiso error: ERR-M-PERMSN-01']);
        }
    }
    
    public function show($id){
        if(Auth::user()->hasPermissionTo('permissions.edit') ){
            return redirect()->route('permissions.edit',$id);
        }
        if(Auth::user()->hasPermissionTo('permissions.show') ){
            $permiso = Permission::find($id);       
            return view('permissions.view');
        }
        abort(403, 'Unauthorized action.');
    }
    
    public function edit($id){
        if(Auth::user()->hasPermissionTo('permissions.edit') ){
            $permission = Permission::find($id);
            $roles = Role::all();
            return view('permissions.edit',compact('permission','roles') );
        }else{
            abort(403, 'Lo sentimos no tienes permisos para realizar esta acción.');
        }
    }
    
    public function update(Request $request,$id)
    {   
        $nombreParaMostrar=$request->input('nombre_para_mostrar');
        $descripcion=$request->input('descripcion');
        $permiso = Permission::find($id);
        $permiso->nameToShow =$nombreParaMostrar;
        $permiso->description = $descripcion;
        $permiso->save();
        return redirect()->route('permissions.edit',$id);
    }
    
    public function destroy(Request $request,$id){
        $permission =  Permission::find($id);
        $permission->delete();
        return redirect('permissions');
    }

    public function assignToRoles(Request $request ,$permission_id){
        //asiganamos un permiso al rol
        $roles = $request->input('roles');
        $permiso=Permission::find($permission_id);
        //$permiso->syncRoles($roles);
        $permiso->assignRole($roles);
        return back();
    }

    public function revokePermissionFromRole(Request $request ,$permission_id){
        $role = $request->input('roles');
        $permiso=Permission::find($permission_id);
        $permiso->removeRole($role);
        return back();
    }
}
