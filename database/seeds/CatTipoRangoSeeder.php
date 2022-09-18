<?php

use Illuminate\Database\Seeder;
use App\CatTipoRango;

class CatTipoRangoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=CatTipoRangoSeeder
     * @return void
     */
    public function run()
    {
        
        CatTipoRango::updateOrCreate(
            ['clave_tipo_rango'=> 'M'],[
                'tipo_rango'=>'MONTO TOTAL MINIMO Y MONTO TOTAL MAXIMO',
                'activo'=> true
            ]);
        CatTipoRango::updateOrCreate(
            ['clave_tipo_rango'=> 'C'],[
                'tipo_rango'=>'CANTIDAD UNIDADES MINIMA Y CANTIDAD UNIDADES MAXIMA',
                'activo'=> true
            ]);

    }
}
