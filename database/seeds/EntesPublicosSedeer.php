<?php

use Illuminate\Database\Seeder;
use App\EntesPulicos;

class EntesPublicosSedeer extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=EntesPublicosSedeer
     * @return void
     */
    public function run()
    {
        EntesPulicos::updateOrCreate(
            [   'ente_publico'=>'SECRETARÍA DE SALUD'],[
                'clave_entpub'=> 'SEDESA',
                'domi_calle'=> null,
                'domi_numext'=> null,
                'domi_numint'=> null,
                'id_asentamiento'=> null,
                'telefono'=> null,
                'ext_tel'=> null,
                'activo'=> true,
                'created_at'=> '2019-08-06 17:29:47',
                'updated_at'=> null,
                'id_i4ch'=> 26
            ]);
        EntesPulicos::updateOrCreate(
            ['ente_publico'=>'RÉGIMEN DE PROTECCIÓN SOCIAL EN SALUD DEL DISTRITO FEDERAL'],[
                'clave_entpub'=> 'REPSS',
                'domi_calle'=> null,
                'domi_numext'=> null,
                'domi_numint'=> null,
                'id_asentamiento'=> null,
                'telefono'=> null,
                'ext_tel'=> null,
                'activo'=> true,
                'created_at'=> '2019-08-06 17:29:47',
                'updated_at'=> null,
                'id_i4ch'=> 194
            ]);
        EntesPulicos::updateOrCreate(
            ['ente_publico'=>'SERVICIOS DE SALUD PÚBLICA DEL DISTRITO FEDERAL'],[
             'clave_entpub'=> 'SSPDF',
             'domi_calle'=> null,
             'domi_numext'=> null,
             'domi_numint'=> null,
             'id_asentamiento'=> null,
             'telefono'=> null,
             'ext_tel'=> null,
             'activo'=> true,
             'created_at'=> '2019-08-06 17:29:47',
             'updated_at'=> null,
             'id_i4ch'=> null
            ]);
        EntesPulicos::updateOrCreate(
            ['ente_publico'=>'SECRETARÍA DE ADMINISTRACIÓN Y FINANZAS'],[
                'clave_entpub'=> 'SAF',
                'domi_calle'=> null,
                'domi_numext'=> null,
                'domi_numint'=> null,
                'id_asentamiento'=> null,
                'telefono'=> null,
                'ext_tel'=> null,
                'activo'=> true,
                'created_at'=> '2019-08-06 17:29:47',
                'updated_at'=> null,
                'id_i4ch'=> 9
            ]);
        EntesPulicos::updateOrCreate(
            ['ente_publico'=>'DIRECCIÓN GENERAL DE LA UNIVERSIDAD DE LA SALUD'],[
                'clave_entpub'=> 'US',
                'domi_calle'=> null,
                'domi_numext'=> null,
                'domi_numint'=> null,
                'id_asentamiento'=> null,
                'telefono'=> null,
                'ext_tel'=> null,
                'activo'=> true,
                'created_at'=> '2019-08-06 17:29:47',
                'updated_at'=> null,
                'id_i4ch'=> null
            ]);
        
    }
}
