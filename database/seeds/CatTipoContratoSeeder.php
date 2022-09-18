<?php

use Illuminate\Database\Seeder;
use App\CatTipoContrato;

class CatTipoContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoContratoSeeder
     * @return void
     */
    public function run()
    {
        CatTipoContrato::updateOrCreate(
            ['clave_tipo_contrato'=> 'C'],[
                'tipo_contrato'=>'CERRADO',
                'activo'=> true
            ]);
        CatTipoContrato::updateOrCreate(
            ['clave_tipo_contrato'=> 'A'],[
                'tipo_contrato'=>'ABIERTO',
                'activo'=> true
            ]);
    }
}
