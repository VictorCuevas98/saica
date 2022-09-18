<?php

use Illuminate\Database\Seeder;
use App\CatTipoEntrada;

class CatTipoEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoEntradaSeeder
     * @return void
     */
    public function run()
    {
        CatTipoEntrada::updateOrCreate(
            ['clave_tipo_entrada'=> 'EPA'],[
                'tipo_entrada'=>'POR ADQUISICIÓN',
                'activo'=> true
            ]);
    }
}
