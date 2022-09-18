<?php

use Illuminate\Database\Seeder;
use App\CatTipoAdquisicion;

class CatTipoAdquisicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoAdquisicionSeeder
     * @return void
     */
    public function run()
    {
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'AD'],[
                'tipo_adquisicion'=>'ADJUDICACIÓN DIRECTA',
                'activo'=> true
            ]);
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'IR'],[
                'tipo_adquisicion'=>'INVITACIÓN RESTRINGIDA',
                'activo'=> true
            ]);
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'LPN'],[
                'tipo_adquisicion'=>'LICITACIÓN PÚBLICA NACIONAL',
                'activo'=> true
            ]);
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'LPI'],[
                'tipo_adquisicion'=>'LICITACIÓN PÚBLICA INTERNACIONAL',
                'activo'=> true
            ]);
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'LPNC'],[
                'tipo_adquisicion'=>'LICITACIÓN PÚBLICA NACIONAL CONSOLIDADA',
                'activo'=> true
            ]);
        CatTipoAdquisicion::updateOrCreate(
            ['clave_tipo_adquisicion'=> 'LPIC'],[
                'tipo_adquisicion'=>'LICITACIÓN PÚBLICA INTERNACIONAL CONSOLIDADA',
                'activo'=> true
            ]);
    }
}
