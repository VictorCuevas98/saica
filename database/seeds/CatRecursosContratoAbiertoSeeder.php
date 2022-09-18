<?php

use Illuminate\Database\Seeder;
use App\CatRecursosContratoAbierto;

class CatRecursosContratoAbiertoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatRecursosContratoAbiertoSeeder
     * @return void
     */
    public function run()
    {
        CatRecursosContratoAbierto::updateOrCreate(
            ['clave_recurso_contrato_abierto'=> 'D'],[
                'recurso_contrato_abierto'=>'RECURSOS DISPONIBLES',
                'activo' => true
            ]);
            CatRecursosContratoAbierto::updateOrCreate(
                ['clave_recurso_contrato_abierto'=> 'A'],[
                    'recurso_contrato_abierto'=>'RECURSOS AGOTADOS',
                    'activo' => true
                ]);
    }
}
