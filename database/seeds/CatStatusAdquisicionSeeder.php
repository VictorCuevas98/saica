<?php

use Illuminate\Database\Seeder;
use App\CatStatusAdquisicion;

class CatStatusAdquisicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatStatusAdquisicionSeeder
     * @return void
     */
    public function run()
    {
        CatStatusAdquisicion::updateOrCreate(
            ['clave_status_adquisicion'=> 'A'],[
                'status_adquisicion'=>'ACTIVA',
                'activo'=> true
            ]);
        CatStatusAdquisicion::updateOrCreate(
            ['clave_status_adquisicion'=> 'C'],[
                'status_adquisicion'=>'CANCELADA',
                'activo'=> true
            ]);
    }
}
