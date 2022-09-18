<?php

use Illuminate\Database\Seeder;
use App\CatNivelCog;

class CatNivelesCogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatNivelesCogSeeder
     * @return void
     */
    public function run()
    {
        
        CatNivelCog::updateOrCreate(
            ['clave_nivel_cog'=>'CAP'],[
                'nivel_cog' => 'CAPITULO',
                'activo'=> true
            ]);
        CatNivelCog::updateOrCreate(
            ['clave_nivel_cog'=>'CON'],[
                'nivel_cog' => 'CONCEPTO',
                'activo'=> true
            ]);
                CatNivelCog::updateOrCreate(
                    ['clave_nivel_cog'=>'PGEN'],[
                        'nivel_cog' => 'PARTIDA PRESUPUESTAL GENERICA',
                        'activo'=> true
                    ]);
    }
}
