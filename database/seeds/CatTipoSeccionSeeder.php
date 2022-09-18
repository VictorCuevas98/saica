<?php

use Illuminate\Database\Seeder;
use App\CatTipoSeccion;

class CatTipoSeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoSeccionSeeder
     * @return void
     */
    public function run()
    {
        CatTipoSeccion::updateOrCreate(
            ['clave_tipo_seccion'=> 'ADQ'],[
                'tipo_seccion'=>'ADQUISICION',
                'activo' => true
            ]);
            CatTipoSeccion::updateOrCreate(
                ['clave_tipo_seccion'=> 'PAGO'],[
                    'tipo_seccion'=>'DOCUMENTOS DE PAGO',
                    'activo' => true
                ]);
                CatTipoSeccion::updateOrCreate(
                    ['clave_tipo_seccion'=> 'CONT'],[
                        'tipo_seccion'=>'CONTRATOS Y CONVENIOS MODIFICATORIOS',
                        'activo' => true
                    ]);
                    CatTipoSeccion::updateOrCreate(
                        ['clave_tipo_seccion'=> 'REV'],[
                            'tipo_seccion'=>'LISTAS DE REVISIÓN DE ENTRADAS',
                            'activo' => true
                        ]);
                        CatTipoSeccion::updateOrCreate(
                            ['clave_tipo_seccion'=> 'PED'],[
                                'tipo_seccion'=>'PEDIDOS A PROVEEDOR',
                                'activo' => true
                            ]);
                            CatTipoSeccion::updateOrCreate(
                                ['clave_tipo_seccion'=> 'SABA'],[
                                    'tipo_seccion'=>'SOLICITUDES DE ABASTECIMIENTO',
                                    'activo' => true
                                ]);
    }
}
