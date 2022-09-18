<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsToEntradascontratosCerradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsToEntradascontratosCerradosSeeder
     * @return void
     */
    public function run()
    {
        
      //CREAR NUEVO ROL PARA MANIPULAR LOS PERMISOS
       $adminUsers = Role::updateOrCreate(['name' => 'entradas por contrato cerrado',],['description' => 'Rol que contiene los permisos para registrar entradas por contratos cerrados']);

       //SE CREAN PERMISOS
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.ver_menu',],['nameToShow' => 'entradas.contratosCerrados.ver_menu','description' => 'permite visualizar el menu de entradas por contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.listar',],['nameToShow' => 'entradas.contratosCerrados.listar','description' => 'permite ver los detalles de la carpeta de contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.ver_registro',],['nameToShow' => 'entradas.contratosCerrados.ver_registro','description' => 'permite visualizar los datos de la carpeta de entradas por contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.cancelar',],['nameToShow' => 'entradas.contratosCerrados.cancelar','description' => 'permite cancelar todas las entradas de una carpeta por contrato cerrado ']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.eliminar',],['nameToShow' => 'entradas.contratosCerrados.eliminar','description' => 'permite eliminar una carpeta de entrada por contrato cerrado']);

       //ASIGNAR
       $adminUsers-> givePermissionTo([
         'entradas.contratosCerrados.ver_menu',
         'entradas.contratosCerrados.listar',
         'entradas.contratosCerrados.ver_registro',
         'entradas.contratosCerrados.cancelar',
         'entradas.contratosCerrados.eliminar',


       ]);

       ##PEWRMISOS DE LISTAS DE REVISION ===========================================================================================================================================
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.lista_de_revision.listar',],['nameToShow' => 'entradas.contratosCerrados.lista_de_revision.listar', 'description' => 'permite ver las listas de revisíón de entrada por contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.lista_de_revision.crear',],['nameToShow' => 'entradas.contratosCerrados.lista_de_revision.crear', 'description' => 'permite crear una lista de revision para entrada por contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.lista_de_revision.editar',],['nameToShow' => 'entradas.contratosCerrados.lista_de_revision.editar', 'description' => 'permite editar una lista de revisión de entrata por contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.lista_de_revision.ver_registro',],['nameToShow' => 'entradas.contratosCerrados.lista_de_revision.ver_registro', 'description' => 'permite visualizar los datos de una lista de revisión por entrada de contrato cerrado']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.lista_de_revision.aprobar',],['nameToShow' => 'entradas.contratosCerrados.lista_de_revision.aprobar', 'description' => 'permite aprobar una lista de revisión']);

       $adminUsers-> givePermissionTo([
         //listas de revision
         'entradas.contratosCerrados.lista_de_revision.listar',
         'entradas.contratosCerrados.lista_de_revision.crear',
         'entradas.contratosCerrados.lista_de_revision.editar',
         'entradas.contratosCerrados.lista_de_revision.ver_registro',
         'entradas.contratosCerrados.lista_de_revision.aprobar'
       ]);

       //##PERMISOS DE ARTICULOS ===========================================================================================================================================
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.articulos.listar',],['nameToShow' => 'entradas.contratosCerrados.articulos.listar', 'description' => 'permite listar los artículos relacionados con una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.articulos.agregar',],['nameToShow' => 'entradas.contratosCerrados.articulos.agregar', 'description' => 'permite agregar artículos relacionados con una entrega en una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.articulos.quitar',],['nameToShow' => 'entradas.contratosCerrados.articulos.quitar', 'description' => 'permite quitar artículos ´relacionados con una entrega en una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosCerrados.articulos.editar',],['nameToShow' => 'entradas.contratosCerrados.articulos.editar_cantidad', 'description' => 'permite editar la cantidad, precio unitario o iva de un artículo en una lista de revisión']);


       $adminUsers-> givePermissionTo([
         'entradas.contratosCerrados.articulos.listar',
         'entradas.contratosCerrados.articulos.agregar',
         'entradas.contratosCerrados.articulos.quitar',
         'entradas.contratosCerrados.articulos.editar',
       ]);


       //# ===========================================================================================================================================
       //BUSCAR AL USUARIO
       $usuario = User::where('rfc','ADMINISTRADOR')->get();
       if ($usuario->count()>0) {
              $usuario->first()->assignRole('entradas por contrato cerrado');
       }
     
    }
}
