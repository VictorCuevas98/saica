<?php

use Illuminate\Database\Seeder;
use App\CatTiposSolicitudAbastecimiento;

class CatTiposSolicitudAbastecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTiposSolicitudAbastecimientoSeeder
     * @return void
     */
    public function run()
    {
        CatTiposSolicitudAbastecimiento::updateOrCreate(
            ['id'=> 'O'],[
                'tipo_solicitud_abastecimiento'=>'ORDINARIO',
                'activo'=> true
            ]);
            CatTiposSolicitudAbastecimiento::updateOrCreate(
            ['id'=> 'E'],[
                'tipo_solicitud_abastecimiento'=>'EXTRAORDINARIO',
                'activo'=> true
            ]);
    }
}
