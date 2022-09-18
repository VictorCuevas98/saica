<?php


use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

  class EntradascontratosAbiertos extends Seeder{

    /**
     * Run the database seeds.
     * php artisan db:seed --class=EntradascontratosAbiertos
     * @return void
     */


     public function run(){
      //CREAR NUEVO ROL PARA MANIPULAR LOS PERMISOS
       $adminUsers = Role::updateOrCreate(['name' => 'entradas por contrato abierto',],['description' => 'Rol que contiene los permisos para registrar entradas por contratos abiertos (antes fondo de oficinas )']);

       //SE CREAN PERMISOS
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.ver_menu',],['nameToShow' => 'entradas.contratosAbiertos.menu','description' => 'permite visualizar el menu de entradas por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista',],['nameToShow' => 'entradas.contratosAbiertos.index','description' => 'permite ver los detalles de la carpeta de contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.crear',],['nameToShow' => 'entradas.contratosAbiertos.nuevo','description' => 'permite crear un nueva carpeta de entrada por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.editar',],['nameToShow' => 'entradas.contratosAbiertos.editar', 'description' => 'permite editar los datos de la carpeta para entrada por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.ver_registro',],['nameToShow' => 'entradas.contratosAbiertos.ver','description' => 'permite visualizar los datos de la carpeta de entradas por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.cancelar',],['nameToShow' => 'entradas.contratosAbiertos.cancelar','description' => 'permite cancelar todas las entradas de una carpeta por contrato abierto ']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.eliminar',],['nameToShow' => 'entradas.contratosAbiertos.cancelar','description' => 'permite eliminar una carpeta de entrada por contrato abierto']);

       //ASIGNAR
       $adminUsers-> givePermissionTo([
         'entradas.contratosAbiertos.ver_menu',
         'entradas.contratosAbiertos.lista',
         'entradas.contratosAbiertos.crear',
         'entradas.contratosAbiertos.editar',
         'entradas.contratosAbiertos.ver_registro',
         'entradas.contratosAbiertos.cancelar',
         'entradas.contratosAbiertos.eliminar',


       ]);

       ##PEWRMISOS DE LISTAS DE REVISION ===========================================================================================================================================
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.listar',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.listar', 'description' => 'permite ver las listas de revisíón de entrada por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.crear',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.crear', 'description' => 'permite crear una lista de revision para entrada por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.editar',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.editar', 'description' => 'permite editar una lista de revisión de entrata por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.ver_registro',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.ver_registro', 'description' => 'permite visualizar los datos de una lista de revisión por entrada de contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.aprobar',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.aprobar', 'description' => 'permite aprobar una lista de revisión de entrada por contrato abierto']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.lista_de_revision.firmar',],['nameToShow' => 'entradas.contratosAbiertos.lista_de_revision.firmar', 'description' => 'permite firmar una lista de revisión']);

       $adminUsers-> givePermissionTo([
         //listas de revision
         'entradas.contratosAbiertos.lista_de_revision.listar',
         'entradas.contratosAbiertos.lista_de_revision.crear',
         'entradas.contratosAbiertos.lista_de_revision.editar',
         'entradas.contratosAbiertos.lista_de_revision.ver_registro',
         'entradas.contratosAbiertos.lista_de_revision.aprobar',
         'entradas.contratosAbiertos.lista_de_revision.firmar'
       ]);

       //##PERMISOS DE ARTICULOS ===========================================================================================================================================
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.articulos.listar',],['nameToShow' => 'entradas.contratosAbiertos.articulos.listar', 'description' => 'permite listar los artículos relacionados con una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.articulos.agregar',],['nameToShow' => 'entradas.contratosAbiertos.articulos.agregar', 'description' => 'permite agregar artículos relacionados con una entrega en una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.articulos.quitar',],['nameToShow' => 'entradas.contratosAbiertos.articulos.quitar', 'description' => 'permite quitar artículos ´relacionados con una entrega en una lista de revisión']);
       permission::updateOrCreate(['name' => 'entradas.contratosAbiertos.articulos.editar_cantidad',],['nameToShow' => 'entradas.contratosAbiertos.articulos.editar_cantidad', 'description' => 'permite editar la cantidad, precio unitario o iva de un artículo en una lista de revisión']);


       $adminUsers-> givePermissionTo([
         'entradas.contratosAbiertos.articulos.listar',
         'entradas.contratosAbiertos.articulos.agregar',
         'entradas.contratosAbiertos.articulos.quitar',
         'entradas.contratosAbiertos.articulos.editar_cantidad',
       ]);


       //# ===========================================================================================================================================
       //BUSCAR AL USUARIO
       $usuario = User::where('rfc','ADMINISTRADOR')->get();
       if ($usuario->count()>0) {
              $usuario->first()->assignRole('entradas por contrato abierto');
       }
     }
  }
