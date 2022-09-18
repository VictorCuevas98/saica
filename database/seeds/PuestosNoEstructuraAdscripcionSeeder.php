<?php

use Illuminate\Database\Seeder;
use App\PuestosNoEstructuraAdscripcion;

class PuestosNoEstructuraAdscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=PuestosNoEstructuraAdscripcionSeeder
     * @return void
     */
    public function run()
    {
        PuestosNoEstructuraAdscripcion::updateOrCreate(
            ['id_puesto_no_estructura'=> 1],[
                'id_unidad_admin'=> 1,
                'fecha_adscripcion'=> '2021-04-26 11:45:04',
                'activo'=> true,
                'created_at'=> '2021-08-16 22:26:24',
                'updated_at'=> null,
            ]);   
            PuestosNoEstructuraAdscripcion::updateOrCreate(
                ['id_puesto_no_estructura'=> 2],[
                    'id_unidad_admin'=> 3,
                    'fecha_adscripcion'=> '2021-04-26 11:45:04',
                    'activo'=> true,
                    'created_at'=> '2021-08-16 22:26:24',
                    'updated_at'=> null,
                ]); 
                PuestosNoEstructuraAdscripcion::updateOrCreate(
                    ['id_puesto_no_estructura'=> 3],[
                        'id_unidad_admin'=> 3,
                        'fecha_adscripcion'=> '2021-04-26 11:45:04',
                        'activo'=> true,
                        'created_at'=> '2021-08-16 22:26:24',
                        'updated_at'=> null,
                    ]); 
                    PuestosNoEstructuraAdscripcion::updateOrCreate(
                        ['id_puesto_no_estructura'=> 4],[
                            'id_unidad_admin'=> 3,
                            'fecha_adscripcion'=> '2021-04-26 11:45:04',
                            'activo'=> true,
                            'created_at'=> '2021-08-16 22:26:24',
                            'updated_at'=> null,
                        ]); 
                        PuestosNoEstructuraAdscripcion::updateOrCreate(
                            ['id_puesto_no_estructura'=> 5],[
                                'id_unidad_admin'=> 4,
                                'fecha_adscripcion'=> '2021-04-26 11:45:04',
                                'activo'=> true,
                                'created_at'=> '2021-08-16 22:26:24',
                                'updated_at'=> null,
                            ]); 
                            PuestosNoEstructuraAdscripcion::updateOrCreate(
                                ['id_puesto_no_estructura'=> 6],[
                                    'id_unidad_admin'=> 3,
                                    'fecha_adscripcion'=> '2021-04-26 11:45:04',
                                    'activo'=> true,
                                    'created_at'=> '2021-08-16 22:26:24',
                                    'updated_at'=> null,
                                ]); 
                                PuestosNoEstructuraAdscripcion::updateOrCreate(
                                    ['id_puesto_no_estructura'=> 7],[
                                        'id_unidad_admin'=> 3,
                                        'fecha_adscripcion'=> '2021-04-26 11:45:04',
                                        'activo'=> true,
                                        'created_at'=> '2021-08-16 22:26:24',
                                        'updated_at'=> null,
                                    ]); 
                                    
    }
}
