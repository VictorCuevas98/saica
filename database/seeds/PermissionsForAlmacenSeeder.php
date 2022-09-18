<?php


use Illuminate\Database\Seeder as Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsForAlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForViewsSeeder
     * @return void
     */
    public function run()
    {
        //CREAMOS LOS PERMISOS
        Permission::create(['name' => 'almacen.entradas.index', 'nameToShow' => 'almacen.entradas.index', 'description' => 'permite listar las entradas']);
        Permission::create(['name' => 'almacen.entredas.create', 'nameToShow' => 'almacen.entradas.create', 'description' => 'permite cargar por Excel / Manual']);
        Permission::create(['name' => 'almacen.entredas.show', 'nameToShow' => 'almacen.entradas.show', 'description' => 'permite mostrar informacion de las entradas']);
        Permission::create(['name' => 'almacen.entredas.edit', 'nameToShow' => 'almacen.entradas.edit', 'description' => 'permite editar informacion de las entradas']);

        Permission::create(['name' => 'almacen.salidas.index', 'nameToShow' => 'almacen.salidas.index', 'description' => 'permite listar las salidas']);
        Permission::create(['name' => 'almacen.salidas.create', 'nameToShow' => 'almacen.salidas.create', 'description' => 'permite crear salida']);
        Permission::create(['name' => 'almacen.salidas.show', 'nameToShow' => 'almacen.salidas.show', 'description' => 'permite mostrar informacion de las salidas']);
        Permission::create(['name' => 'almacen.salidas.edit', 'nameToShow' => 'almacen.salidas.edit', 'description' => 'permite editar informacion de las salidas']);


        Permission::create(['name' => 'almacen.pedidos.index', 'nameToShow' => 'almacen.pedidos.index', 'description' => 'permite listar los pedidos']);
        Permission::create(['name' => 'almacen.pedidos.show', 'nameToShow' => 'almacen.pedidos.show', 'description' => 'permite mostrar informacion de los pedidos']);

        //CREAR EL NUEVO ROL
        $adminUsers = Role::create(['name' => 'admin.almacen', 'description' => 'Rol que permite el acceso a contratos, almacen, unidad medica']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'almacen.entradas.index',
            'almacen.entredas.create',
            'almacen.entredas.show',
            'almacen.entredas.edit',

            'almacen.salidas.index',
            'almacen.salidas.create',
            'almacen.salidas.show',
            'almacen.salidas.edit',

            'almacen.pedidos.index',
            'almacen.pedidos.show',
        ]);


        //BUSCAR AL USUARIO
        $usuario = User::where('rfc', 'ADMINISTRADOR')->get();
        if ($usuario->count() > 0) {
            //ASIGNARLE EL NUEVO ROL
            $usuario->first()->assignRole('admin.almacen');
        }
    }
}
