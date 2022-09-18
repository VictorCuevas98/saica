<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;



class PermissionsForUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForUsersSeeder
     * @return void
     */
    public function run()
    {
        //
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

		Permission::updateOrCreate(['name' => 'users.index','nameToShow'=>'users.index','description'=>'permite listar los usuarios']);
		Permission::updateOrCreate(['name' => 'users.edit','nameToShow'=>'users.edit','description'=>'permite editar la informacion de un usuario']);
		Permission::updateOrCreate(['name' => 'users.show','nameToShow'=>'users.show','description'=>'permite mostrar la informacion de un usuario']);
		Permission::updateOrCreate(['name' => 'users.create','nameToShow'=>'users.create','description'=>'permite crear usuarios']);
		Permission::updateOrCreate(['name' => 'users.destroy','nameToShow'=>'users.destroy','description'=>'permite eliminar usuarios']);
		Permission::updateOrCreate(['name' => 'users.edit.roles','nameToShow'=>'users.edit.roles','description'=>'permite editar los roles de los usuarios']);

		//CREAR EL NUEVO ROL
		 $adminUsers = Role::updateOrCreate(['name' => 'admin.users','description'=>'Rol que permite manipular los usuarios del sistema']);


		//ASIGNAR LOS NUEVOS PERMISOS
		$adminUsers->givePermissionTo('users.index');
		$adminUsers->givePermissionTo('users.edit');
		$adminUsers->givePermissionTo('users.show');
		$adminUsers->givePermissionTo('users.create');
		$adminUsers->givePermissionTo('users.destroy');
		$adminUsers->givePermissionTo('users.edit.roles');


		//BUSCAR AL USUARIO
		$usuario = User::where('rfc','ADMINISTRADOR')->get();
        if($usuario->count()>0){
	        //ASIGNARLE EL NUEVO ROL
        	$usuario->first()->assignRole('admin.users');
        }


    }
}
