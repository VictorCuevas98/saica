<?php

use Illuminate\Database\Seeder;
use App\CatTipoParticipanteContrato;

class CatTipoParticipanteContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoParticipanteContratoSeeder
     * @return void
     */
    public function run()
    {
        CatTipoParticipanteContrato::updateOrCreate(
            ['clave_tipo_participante_contrato'=> 'ELA'],[
                'tipo_participante_contrato'=>'ELABORA EL CONTRATO'
            ]);
        CatTipoParticipanteContrato::updateOrCreate(
            ['clave_tipo_participante_contrato'=> 'REV'],[
                'tipo_participante_contrato'=>'REVISA EL CONTRATO'
            ]);
        CatTipoParticipanteContrato::updateOrCreate(
            ['clave_tipo_participante_contrato'=> 'AUT'],[
                'tipo_participante_contrato'=>'AUTORIZA EL CONTRATO'
            ]);
        CatTipoParticipanteContrato::updateOrCreate(
            ['clave_tipo_participante_contrato'=> 'PRO'],[
                'tipo_participante_contrato'=>'PROVEEDOR'
            ]);
    }
}
