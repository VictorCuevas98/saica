<?php

use Illuminate\Database\Seeder;
use App\CatStatusEntrada;

class CatStatusEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatStatusEntradaSeeder
     * @return void
     */
    public function run()
    {
        CatStatusEntrada::updateOrCreate(
            ['clave_status_entrada'=> 'A'],[
                'status_entrada'=>'APROBADA',
                'activo'=> true
            ]);
        CatStatusEntrada::updateOrCreate(
            ['clave_status_entrada'=> 'AO'],[
                'status_entrada'=>'APROBADA CON OBSERVACIONES',
                'activo'=> true
            ]);
        CatStatusEntrada::updateOrCreate(
            ['clave_status_entrada'=> 'R'],[
                'status_entrada'=>'RECHAZADA',
                'activo'=> true
            ]);
        CatStatusEntrada::updateOrCreate(
            ['clave_status_entrada'=> 'C'],[
                'status_entrada'=>'CANCELADA',
                'activo'=> true
            ]);
    }
}
