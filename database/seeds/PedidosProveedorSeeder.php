<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PedidosProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::where('name','=','pedidos proveedor')->first() == null){
            $role = new Role();
            $role->name = 'pedidos proveedor';
            $role->description = 'Podra ver el menu de Almacen -> Pedidos Proveedor';
            $role->save();
        }
    }
}
