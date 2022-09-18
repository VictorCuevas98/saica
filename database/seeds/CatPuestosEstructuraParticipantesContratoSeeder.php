<?php

use Illuminate\Database\Seeder;
use App\CatPuestoEstructuraParticipanteContrato;

class CatPuestosEstructuraParticipantesContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatPuestosEstructuraParticipantesContratoSeeder
     * @return void
     */
    public function run()
    {
        CatPuestoEstructuraParticipanteContrato::updateOrCreate(
            ['id_tipo_participante_contrato'=> 1],[
                'id_puesto_estructura' => 239,
                'activo'=> true
            ]);
        CatPuestoEstructuraParticipanteContrato::updateOrCreate(
            ['id_tipo_participante_contrato'=> 2],[
                'id_puesto_estructura' => 237,
                'activo'=> true
            ]);
        CatPuestoEstructuraParticipanteContrato::updateOrCreate(
            ['id_tipo_participante_contrato'=> 3],[
                'id_puesto_estructura' => 236,
                'activo'=> true
            ]);
       
    }
}
