<?php

use Illuminate\Database\Seeder;
use App\Proveedor;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=ProveedoresSeeder
     * @return void
     */
    public function run()
    {
        Proveedor::updateOrCreate(
            ['rfc'=> 'CSI130326HD1'],[
             'tipo_persona'=>'M',
             'fisica_nombre'=> null,
             'fisica_primer_ap'=> null,
             'fisica_segundo_ap'=> null,
             'razon_social'=> 'CIRKLOMED SOLUCIONES INTEGRALES, S.A. DE C.V.',
             'representante_legal'=> null,
             'activo'=> true
            ]);
        Proveedor::updateOrCreate(
            ['rfc'=> 'RASJ920216HQ7'],[
                'tipo_persona'=>'F',
                'fisica_nombre'=> 'JESSICA',
                'fisica_primer_ap'=> 'RAMIREZ',
                'fisica_segundo_ap'=> 'SOLANO',
                'razon_social'=> null,
                'representante_legal'=> null,
                'activo'=> true
            ]);
            Proveedor::updateOrCreate(
                ['rfc'=> 'CAJJ601225ABC'],[
                    'tipo_persona'=>'F',
                    'fisica_nombre'=> 'Ma de JEsu',
                    'fisica_primer_ap'=> 'Casi',
                    'fisica_segundo_ap'=> 'Jua',
                    'razon_social'=> null,
                    'representante_legal'=> 'Ma de JEsus',
                    'activo'=> true
                ]);
    }
}
