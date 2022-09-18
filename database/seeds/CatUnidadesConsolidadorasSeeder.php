<?php

use Illuminate\Database\Seeder;
use App\CatUnidadConsolidadora;

class CatUnidadesConsolidadorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatUnidadesConsolidadorasSeeder
     * @return void
     */
    public function run()
    {
        CatUnidadConsolidadora::updateOrCreate(
            ['clave_unidad_consolidadora'=> 'DGRMSG'],[
                'unidad_consolidadora'=>'DIRECCIÓN GENERAL DE RECURSOS MATERIALES Y SERVICIOS GENERALES (SAF)',
                'id_orden_gobierno'=> 1,
                'activo'=> true
            ]);
        CatUnidadConsolidadora::updateOrCreate(
            ['clave_unidad_consolidadora'=> 'INSABI'],[
                'unidad_consolidadora'=>'INSTITUTO DE SALUD PARA EL BIENESTAR',
                'id_orden_gobierno'=> 2,
                'activo'=> true
            ]);
    }
}
