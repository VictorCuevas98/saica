<?php


use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsForUnidadMedicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForViewsSeeder
     * @return void
     */
    public function run()
    {
        //CREAMOS LOS PERMISOS
        Permission::create(['name' => 'unidadMedica.pedidos.index','nameToShow'=>'permissions.index','description'=>'permite listar los pedidos']);
        Permission::create(['name' => 'unidadMedica.pedidos.create','nameToShow'=>'permissions.index','description'=>'permite crear pedidos']);
        Permission::create(['name' => 'unidadMedica.pedidos.show','nameToShow'=>'permissions.index','description'=>'permite mostrar informacion de los pedidos']);
        Permission::create(['name' => 'unidadMedica.pedidos.edit','nameToShow'=>'permissions.edit','description'=>'permite editar informacion de los pedidos']);
        Permission::create(['name' => 'unidadMedica.pedidos.destroy','nameToShow'=>'permissions.destroy','description'=>'permite eliminar pedidos']);

        //CREAR EL NUEVO ROL
        $adminUsers = Role::create(['name' => 'admin.unidadMedica','description'=>'Rol que permite crear y mostrar pedidos']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'unidadMedica.pedidos.index',
            'unidadMedica.pedidos.create',
            'unidadMedica.pedidos.show',
            'unidadMedica.pedidos.edit',
            'unidadMedica.pedidos.destroy',
        ]);


        //BUSCAR AL USUARIO
        $usuario = User::where('rfc','ADMINISTRADOR')->get();
        if($usuario->count()>0){
            //ASIGNARLE EL NUEVO ROL
            $usuario->first()->assignRole('admin.unidadMedica');
        }
    }
}
