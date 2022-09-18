<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsForCatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForCatalogosSeeder
     * @return void
     */
    public function run()
    {
        
        //CREAR EL NUEVO ROL PARA EL CATÁLOGO ARTICULOS
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.articulos','description'=>'Rol que permite crear, editar y mostrar el catalogo articulos']);

        //Se generan permisos
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.articulos.verRegistros','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite listar el catalogo de artículos en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.articulos.nuevoArticulo','nameToShow'=>'catalogos.articulos.nuevoArticulo','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu articulos']);
        Permission::updateOrCreate(['name' => 'catalogos.articulos.editarArticulo','nameToShow'=>'catalogos.articulos.editarArticulo','description'=>'permite editar un registro existenten en el modulo de catalogos submenu articulos']);

        //ASIGNAR LOS NUEVOS PERMISOS ARTICULOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.articulos.verRegistros',
            'catalogos.articulos.nuevoArticulo',
            'catalogos.articulos.editarArticulo',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO ALMACENES
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.almacenes','description'=>'Rol que permite crear, editar y mostrar el catalogo almacenes']);

        //Se generan permisos
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.almacenes.verRegistros','nameToShow'=>'catalogos.almacenes.verRegistrosAlmacenes','description'=>'permite listar el catalogo de almacenes en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.almacenes.nuevoAlmacen','nameToShow'=>'catalogos.almacenes.nuevoAlmacen','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu almacenes']);
        Permission::updateOrCreate(['name' => 'catalogos.almacenes.editarAlmacen','nameToShow'=>'catalogos.almacenes.editarAlmacen','description'=>'permite editar un registro existenten en el modulo de catalogos submenu almacenes']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.almacenes.verRegistros',
            'catalogos.almacenes.nuevoAlmacen',
            'catalogos.almacenes.editarAlmacen',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO CABMS
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.cabms','description'=>'Rol que permite crear, editar y mostrar el catalogo cabms']);

        //Cabms
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.cabms.verRegistros','nameToShow'=>'catalogos.cabms.verRegistros','description'=>'permite listar el catalogo de cabms en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.cabms.nuevoCabms','nameToShow'=>'catalogos.cabms.nuevoCabms','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu cabms']);
        Permission::updateOrCreate(['name' => 'catalogos.cabms.editarCabms','nameToShow'=>'catalogos.cabms.editarCabms','description'=>'permite editar un registro existenten en el modulo de catalogos submenu cabms']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.cabms.verRegistros',
            'catalogos.cabms.nuevoCabms',
            'catalogos.cabms.editarCabms',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO FUNDAMENTO LEGAL
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.fundamentoLegal','description'=>'Rol que permite crear, editar y mostrar el catalogo fundamento legal']);

         //Fundamento legal
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.fundamentoLegal.verRegistros','nameToShow'=>'catalogos.fundamentoLegal.verRegistrosFundamentoLegal','description'=>'permite listar el catalogo de fundamento legal en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.fundamentoLegal.nuevoFundamentoLegal','nameToShow'=>'catalogos.fundamentoLegal.nuevoFundamentoLegal','description'=>'permite crear un nuevo registro en el modulo catalogo fundamento legal']);
        Permission::updateOrCreate(['name' => 'catalogos.fundamentoLegal.editarFundamentoLegal','nameToShow'=>'catalogos.fundamentoLegal.editarFundamentoLegal','description'=>'permite editar un registro existenten en el modulo catalogo fundamento legal']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.fundamentoLegal.verRegistros',
            'catalogos.fundamentoLegal.nuevoFundamentoLegal',
            'catalogos.fundamentoLegal.editarFundamentoLegal',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO LABORATORIOS
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.laboratorios','description'=>'Rol que permite crear, editar y mostrar el catalogo laboratorios']);

        //Laboratorio
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.laboratorios.verRegistros','nameToShow'=>'catalogos.laboratorios.verRegistros','description'=>'permite listar el catalogo de laboratorios en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.laboratorios.nuevoLaboratorio','nameToShow'=>'catalogos.laboratorios.nuevoLaboratorio','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu laboratorios']);
        Permission::updateOrCreate(['name' => 'catalogos.laboratorios.editarLaboratorio','nameToShow'=>'catalogos.laboratorios.editarLaboratorio','description'=>'permite editar un registro existenten en el modulo de catalogos submenu laboratorios']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.laboratorios.verRegistros',
            'catalogos.laboratorios.nuevoLaboratorio',
            'catalogos.laboratorios.editarLaboratorio',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO PARTIDAS ESPECIFICAS 
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.partidasEspecificas','description'=>'Rol que permite crear, editar y mostrar el catalogo partidas especificas']);

        //Partida especificas
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.partidasEspecificas.verRegistros','nameToShow'=>'catalogos.partidasEspecificas.verRegistros','description'=>'permite listar el catalogo de partidas especificas en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.partidasEspecificas.nuevoPartida','nameToShow'=>'catalogos.partidasEspecificas.nuevoPartida','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu partidas especificas']);
        Permission::updateOrCreate(['name' => 'catalogos.partidasEspecificas.editarPartida','nameToShow'=>'catalogos.partidasEspecificas.editarPartida','description'=>'permite editar un registro existenten en el modulo de catalogos submenu partidas especificas']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.partidasEspecificas.verRegistros',
            'catalogos.partidasEspecificas.nuevoPartida',
            'catalogos.partidasEspecificas.editarPartida',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO PREGUNTAS REVISIÓN
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.preguntasRevision','description'=>'Rol que permite crear, editar y mostrar el catalogo preguntas revisión']);

        //Preguntas revision
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.preguntasRevision.verRegistros','nameToShow'=>'catalogos.preguntasRevision.verRegistros','description'=>'permite listar el catalogo de preguntas revisión entrada en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.preguntasRevision.nuevoPreguntasRevision','nameToShow'=>'catalogos.preguntasRevision.nuevoPreguntasRevision','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu preguntas revisión entrada']);
        Permission::updateOrCreate(['name' => 'catalogos.preguntasRevision.editarPreguntasRevision','nameToShow'=>'catalogos.preguntasRevision.editarPreguntasRevision','description'=>'permite editar un registro existenten en el modulo de catalogos submenu preguntas revisión entrada']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.preguntasRevision.verRegistros',
            'catalogos.preguntasRevision.nuevoPreguntasRevision',
            'catalogos.preguntasRevision.editarPreguntasRevision',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        //CREAR EL NUEVO ROL PARA EL CATÁLOGO UNIDADES CONSOLIDADORAS
        $adminUsers = Role::updateOrCreate(['name' => 'admin.catalogos.unidadesConsolidadoras','description'=>'Rol que permite crear, editar y mostrar el catalogo unidades consolidadoras']);

        //Unidades consolidadoras
        Permission::updateOrCreate(['name' => 'catalogos.verMenu','nameToShow'=>'catalogos.articulos.verRegistros','description'=>'permite permite visualizar el menu catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.unidadesConsolidadoras.verRegistros','nameToShow'=>'catalogos.unidadesConsolidadoras.verRegistros','description'=>'permite listar el catalogo de unidades consolidadoras en el modulo de catalogos']);
        Permission::updateOrCreate(['name' => 'catalogos.unidadesConsolidadoras.nuevoUnidadConsolidadora','nameToShow'=>'catalogos.unidadesConsolidadoras.nuevoUnidadConsolidadora','description'=>'permite crear un nuevo registro en el modulo de catalogos submenu unidades consolidadoras']);
        Permission::updateOrCreate(['name' => 'catalogos.unidadesConsolidadoras.editarUnidadConsolidadora','nameToShow'=>'catalogos.unidadesConsolidadoras.editarUnidadConsolidadora','description'=>'permite editar un registro existenten en el modulo de catalogos submenu unidades consolidadoras']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'catalogos.verMenu',
            'catalogos.unidadesConsolidadoras.verRegistros',
            'catalogos.unidadesConsolidadoras.nuevoUnidadConsolidadora',
            'catalogos.unidadesConsolidadoras.editarUnidadConsolidadora',
        ]);

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------*/       
        //BUSCAR AL USUARIO
        $usuario = User::where('rfc','ADMINISTRADOR')->get();
        if($usuario->count()>0){
            //ASIGNARLE EL NUEVO ROL
            $usuario->first()->assignRole('admin.catalogos.articulos');
            $usuario->first()->assignRole('admin.catalogos.almacenes');
            $usuario->first()->assignRole('admin.catalogos.cabms');
            $usuario->first()->assignRole('admin.catalogos.fundamentoLegal');
            $usuario->first()->assignRole('admin.catalogos.laboratorios');
            $usuario->first()->assignRole('admin.catalogos.partidasEspecificas');
            $usuario->first()->assignRole('admin.catalogos.preguntasRevision');
            $usuario->first()->assignRole('admin.catalogos.unidadesConsolidadoras');
        }
    }
}
