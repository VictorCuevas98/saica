<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsForPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForPermissionsSeeder
     * @return void
     */
    public function run()
    {
        //CREAMOS LOS PERMISOS
		Permission::updateOrCreate(['name' => 'permissions.index','nameToShow'=>'permissions.index','description'=>'permite listar los permisos']);
		Permission::updateOrCreate(['name' => 'permissions.edit','nameToShow'=>'permissions.edit','description'=>'permite editar la información de los permisos']);
		Permission::updateOrCreate(['name' => 'permissions.show','nameToShow'=>'permissions.show','description'=>'permite mostrar la información de los permisos']);
		Permission::updateOrCreate(['name' => 'permissions.create','nameToShow'=>'permissions.create','description'=>'permite crear permisos']);
		Permission::updateOrCreate(['name' => 'permissions.destroy','nameToShow'=>'permissions.destroy','description'=>'permite eliminar permisos']);
		Permission::updateOrCreate(['name' => 'permissions.addToRole','nameToShow'=>'permissions.addToRole','description'=>'permite agregar un permiso a un rol']);
		
		//CREAR EL NUEVO ROL
		$adminUsers = Role::updateOrCreate(['name' => 'admin.permissions','description'=>'Rol que permite manipular los permisos del sistema']);
		
		//ASIGNAR LOS NUEVOS PERMISOS
		$adminUsers->givePermissionTo([
			'permissions.index',
			'permissions.edit',
			'permissions.show',
			'permissions.create',
			'permissions.destroy',
			'permissions.addToRole'
			]);
		
		
		//BUSCAR AL USUARIO	
		$usuario = User::where('rfc','ADMINISTRADOR')->get();
        if($usuario->count()>0){
	        //ASIGNARLE EL NUEVO ROL
        	$usuario->first()->assignRole('admin.permissions');
        }
    }
}
