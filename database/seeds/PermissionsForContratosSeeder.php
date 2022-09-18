<?php


use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsForContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionsForViewsSeeder
     * @return void
     */
    public function run()
    {
        //CREAR EL NUEVO ROL
        $adminUsers = Role::updateOrCreate(['name' => 'admin.contratos', 'description' => 'Rol que permite crear y mostrar los contratos']);

        //CREAMOS LOS PERMISOS
        Permission::updateOrCreate(['name' => 'contratos.index', 'nameToShow' => 'contratos.index', 'description' => 'permite listar los contratos']);
        Permission::updateOrCreate(['name' => 'contratos.store', 'nameToShow' => 'contratos.store', 'description' => 'permite almacenar nuevo contrato']);
        Permission::updateOrCreate(['name' => 'contratos.create', 'nameToShow' => 'contratos.create', 'description' => 'permite mostrar vista para almacenar nuevo contrato']);
        Permission::updateOrCreate(['name' => 'contratos.update', 'nameToShow' => 'contratos.update', 'description' => 'permite actualizar contrato']);
        Permission::updateOrCreate(['name' => 'contratos.destroy', 'nameToShow' => 'contratos.destroy', 'description' => 'permite eliminar contratos']);
        Permission::updateOrCreate(['name' => 'contratos.show', 'nameToShow' => 'contratos.show', 'description' => 'permite mostrar la informacion del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.edit', 'nameToShow' => 'contratos.edit', 'description' => 'permite editar la informacion del contrato']);

        $adminUsers->givePermissionTo([
            'contratos.index',
            'contratos.store',
            'contratos.create',
            'contratos.update',
            'contratos.destroy',
            'contratos.show',
            'contratos.edit',
        ]);


        Permission::updateOrCreate(['name' => 'contratos.destroy.contrato_articulo', 'nameToShow' => 'contratos.destroy.contrato_articulo', 'description' => 'permite eliminar un articulo asociado al contrato']);
        Permission::updateOrCreate(['name' => 'contratos.show.contrato_archivo', 'nameToShow' => 'contratos.show.contrato_archivo', 'description' => 'permite mostrar la informacion del archivo del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.show.contrato_articulo', 'nameToShow' => 'contratos.show.contrato_articulo', 'description' => 'permite mostrar la informacion de los articulos del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.show.contrato_artmed', 'nameToShow' => 'contratos.show.contrato_artmed', 'description' => 'permite mostrar la informacion del articulo medico del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.create.contrato.artmed', 'nameToShow' => 'contratos.create.contrato.artmed', 'description' => 'permite mostrar la vista para crear un articulo medico del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.edit.contrato_artmed', 'nameToShow' => 'contratos.edit.contrato_artmed', 'description' => 'permite editar un articulo medico del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.store.articulo.contrato_abierto', 'nameToShow' => 'contratos.store.articulo.contrato_abierto', 'description' => 'permite almacenar un contrato abierto']);
        Permission::updateOrCreate(['name' => 'contratos.store.articulo.contrato_cerrado', 'nameToShow' => 'contratos.store.articulo.contrato_cerrado', 'description' => 'permite almacenar un contrato cerrado']);
        Permission::updateOrCreate(['name' => 'contratos.store.articulo.contrato_abierto_detalle', 'nameToShow' => 'contratos.store.articulo.contrato_abierto_detalle', 'description' => 'permite almacenar un contrato abierto detalle']);
        Permission::updateOrCreate(['name' => 'contratos.store.articulo.contrato_cerrado_detalle', 'nameToShow' => 'contratos.store.articulo.contrato_cerrado_detalle', 'description' => 'permite almacenar un contrato cerrado detalle']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'contratos.show.contrato_archivo',
            'contratos.show.contrato_articulo',
            'contratos.destroy.contrato_articulo',
            'contratos.show.contrato_artmed',
            'contratos.create.contrato.artmed',
            'contratos.edit.contrato_artmed',
            'contratos.store.articulo.contrato_abierto',
            'contratos.store.articulo.contrato_cerrado',
            'contratos.store.articulo.contrato_abierto_detalle',
            'contratos.store.articulo.contrato_cerrado_detalle',
        ]);

        Permission::updateOrCreate(['name' => 'contratos.advance_search', 'nameToShow' => 'contratos.advance_search', 'description' => 'permite busqueda avanzada de contratos']);
        Permission::updateOrCreate(['name' => 'contratos.destroy.file', 'nameToShow' => 'contratos.destroy.file', 'description' => 'permite eliminar archivo pdf']);
        Permission::updateOrCreate(['name' => 'contratos.show.pdf', 'nameToShow' => 'contratos.show.pdf', 'description' => 'permite mostrar el pdf asociado al contrato']);
        Permission::updateOrCreate(['name' => 'contratos.show.previsualizacion', 'nameToShow' => 'contratos.show.previsualizacion', 'description' => 'permite mostrar la informacion de la previsualizacion del contrato']);
        Permission::updateOrCreate(['name' => 'contratos.store.adquisicion', 'nameToShow' => 'contratos.store.adquisicion', 'description' => 'permite almacenar una adquisicion o actualizarla']);
        Permission::updateOrCreate(['name' => 'contratos.store.articulo', 'nameToShow' => 'contratos.store.articulo', 'description' => 'permite almacenar un articulo']);
        Permission::updateOrCreate(['name' => 'contratos.store.file', 'nameToShow' => 'contratos.store.file', 'description' => 'permite almacenar un archivo']);
        Permission::updateOrCreate(['name' => 'contratos.store.previsualizacion', 'nameToShow' => 'contratos.store.previsualizacion', 'description' => 'permite almacenar la previsualizacion']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'contratos.advance_search',
            'contratos.destroy.file',
            'contratos.show.pdf',
            'contratos.show.previsualizacion',
            'contratos.store.adquisicion',
            'contratos.store.articulo',
            'contratos.store.file',
            'contratos.store.previsualizacion',
        ]);



        Permission::updateOrCreate(['name' => 'contratos.check_contrato', 'nameToShow' => 'contratos.check_contrato', 'description' => 'permite revisar si existe un contrato']);
        Permission::updateOrCreate(['name' => 'adquisicion.check_requisicion', 'nameToShow' => 'adquisicion.check_requisicion', 'description' => 'permite revisar si existe una requisicion']);
        Permission::updateOrCreate(['name' => 'adquisicion.check_adjudicacion', 'nameToShow' => 'adquisicion.check_adjudicacion', 'description' => 'permite revisar si existe una adjudicacion']);

        //ASIGNAR LOS NUEVOS PERMISOS
        $adminUsers->givePermissionTo([
            'contratos.check_contrato',
            'adquisicion.check_requisicion',
            'adquisicion.check_adjudicacion',
        ]);

        //BUSCAR AL USUARIO
        $usuario = User::where('rfc', 'ADMINISTRADOR')->get();
        if ($usuario->count() > 0) {
            //ASIGNARLE EL NUEVO ROL
            $usuario->first()->assignRole('admin.contratos');
        }
    }
}
