<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class PermissionsForRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForRolesSeeder
     * @return void
     */
    public function run()
    {
        //CREAMOS LOS PERMISOS
		Permission::updateOrCreate(['name' => 'roles.index','nameToShow'=>'roles.index','description'=>'permite listar los roles ']);
		Permission::updateOrCreate(['name' => 'roles.edit','nameToShow'=>'roles.edit','description'=>'permite editar la informacion de los roles']);
		Permission::updateOrCreate(['name' => 'roles.show','nameToShow'=>'roles.show','description'=>'permite mostrar los roles']);
		Permission::updateOrCreate(['name' => 'roles.create','nameToShow'=>'roles.create','description'=>'permite crear roles']);
		Permission::updateOrCreate(['name' => 'roles.destroy','nameToShow'=>'roles.destroy','description'=>'permite eliminar los roles']);
		Permission::updateOrCreate(['name' => 'roles.edit.permissions','nameToShow'=>'roles.edit.permissions','description'=>'permite modificar los permisos de los roles']);
	
		//CREAR EL NUEVO ROL
		 $adminUsers = Role::updateOrCreate(['name' => 'admin.roles','description'=>'Rol que permite manipular los roles']);
		
		
		//ASIGNAR LOS NUEVOS PERMISOS
		$adminUsers->givePermissionTo([
				'roles.index',
				'roles.edit',
				'roles.show',
				'roles.create',
				'roles.destroy',
				'roles.edit.permissions'
			]);
		
		
		//BUSCAR AL USUARIO	
		$usuario = User::where('rfc','ADMINISTRADOR')->get();
        if($usuario->count()>0){
	        //ASIGNARLE EL NUEVO ROL
        	$usuario->first()->assignRole('admin.roles');
        }
		
    }
}
