<?php

use Illuminate\Database\Seeder;
use App\CatLaboratorio;

class CatLaboratorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatLaboratorioSeeder
     * @return void
     */
    public function run()
    {
        
        $lab1= CatLaboratorio::updateOrCreate(
            ['clave_laboratorio'=>'L1'],[
                'laboratorio'=>'LABORATORIO 1',
                'activo'=> true
            ]);
        $lab2= CatLaboratorio::updateOrCreate(
            ['clave_laboratorio'=>'L2']
            ,
            [
                'laboratorio'=>'LABORATORIO 2',
                'activo'=> true
            ]
        );

    }
}
