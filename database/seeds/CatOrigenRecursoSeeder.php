<?php

use Illuminate\Database\Seeder;
use App\CatOrigenRecurso;

class CatOrigenRecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatOrigenRecursoSeeder
     * @return void
     */
    public function run()
    {
        CatOrigenRecurso::updateOrCreate(
            ['clave_origen_recurso'=> 'RF'],[
                'origen_recurso'=>'RECURSOS FISCALES',
                'activo'=> true
            ]);

        CatOrigenRecurso::updateOrCreate(
            ['clave_origen_recurso'=> 'FI'],[
                'origen_recurso'=>'FINANCIAMIENTOS INTERNOS',
                'activo'=> true
            ]);

        CatOrigenRecurso::updateOrCreate(
            ['clave_origen_recurso'=> 'IP'],[
                'origen_recurso'=>'INGRESOS PROPIOS',
                'activo'=> true
            ]);
        CatOrigenRecurso::updateOrCreate(
            ['clave_origen_recurso'=> 'RFED'],[
                'origen_recurso'=>'RECURSOS FEDERALES',
                'activo'=> true
            ]);
    }
}
