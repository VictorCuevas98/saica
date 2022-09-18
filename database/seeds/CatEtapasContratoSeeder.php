<?php

use Illuminate\Database\Seeder;
use App\CatEtapasContrato;

class CatEtapasContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatEtapasContratoSeeder
     * @return void
     */
    public function run()
    {
        CatEtapasContrato::updateOrCreate(
            ['clave_etapa_contrato'=>'PRO'],[
                'etapa_contrato'=> 'EN PROCESO',
                'activo'=> true,
                'created_at' =>'2021-09-06 11:00:18',
                'updated_at' => null
            ]);
            CatEtapasContrato::updateOrCreate(
                ['clave_etapa_contrato'=>'REV'],[
                    'etapa_contrato'=> 'EN REVISION',
                    'activo'=> true,
                    'created_at' =>'2021-09-06 11:00:18',
                    'updated_at' => null
                ]);
                CatEtapasContrato::updateOrCreate(
                    ['clave_etapa_contrato'=>'RCH'],[
                        'etapa_contrato'=> 'RECHAZADO',
                        'activo'=> true,
                        'created_at' =>'2021-09-06 11:00:18',
                        'updated_at' => null
                    ]);
                    CatEtapasContrato::updateOrCreate(
                        ['clave_etapa_contrato'=>'APR'],[
                            'etapa_contrato'=> 'APROBADO',
                            'activo'=> true,
                            'created_at' =>'2021-09-06 11:00:18',
                            'updated_at' => null
                        ]);
                        CatEtapasContrato::updateOrCreate(
                            ['clave_etapa_contrato'=>'FIR'],[
                                'etapa_contrato'=> 'SEGUIMIENTO FIRMAS',
                                'activo'=> true,
                                'created_at' =>'2021-09-06 11:00:18',
                                'updated_at' => null
                            ]);
                            CatEtapasContrato::updateOrCreate(
                                ['clave_etapa_contrato'=>'CON'],[
                                    'etapa_contrato'=> 'CONCLUIDO',
                                    'activo'=> true,
                                    'created_at' =>'2021-09-06 11:00:18',
                                    'updated_at' => null
                                ]);
                                CatEtapasContrato::updateOrCreate(
                                    ['clave_etapa_contrato'=>'PUB'],[
                                        'etapa_contrato'=> 'PUBLICADO',
                                        'activo'=> true,
                                        'created_at' =>'2021-09-06 11:00:18',
                                        'updated_at' => null
                                    ]);
                                    CatEtapasContrato::updateOrCreate(
                                        ['clave_etapa_contrato'=>'CAN'],[
                                            'etapa_contrato'=> 'CANCELADO',
                                            'activo'=> true,
                                            'created_at' =>'2021-09-06 11:00:18',
                                            'updated_at' => null
                                        ]);
    }
}
