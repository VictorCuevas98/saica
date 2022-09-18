<?php

use Illuminate\Database\Seeder;
use App\CatTipoContratacion;

class CatTipoContratacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoContratacionSeeder
     * @return void
     */
    public function run()
    {
        CatTipoContratacion::updateOrCreate(
            ['clave_tipo_contratacion'=> 'E'],[
                'tipo_contratacion'=>'ESTRUCTURA',
                'activo'=> true,
                'created_at'=> '2021-08-24 11:01:40',
            ]);
            CatTipoContratacion::updateOrCreate(
                ['clave_tipo_contratacion'=> 'B'],[
                    'tipo_contratacion'=>'BASE',
                    'activo'=> true,
                    'created_at'=> '2021-08-24 11:01:40',
                ]);
                CatTipoContratacion::updateOrCreate(
                    ['clave_tipo_contratacion'=> 'H'],[
                        'tipo_contratacion'=>'HONORARIOS',
                        'activo'=> true,
                        'created_at'=> '2021-08-24 11:01:40',
                    ]);
                    CatTipoContratacion::updateOrCreate(
                        ['clave_tipo_contratacion'=> 'T'],[
                            'tipo_contratacion'=>'TECNICO-OPERATIVO',
                            'activo'=> true,
                            'created_at'=> '2021-08-24 11:01:40',
                        ]);
    }
}
