<?php

use Illuminate\Database\Seeder;
use App\CatTipoDocContrato;

class CatTipoDocContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoDocContratoSeeder
     * @return void
     */
    public function run()
    {
        CatTipoDocContrato::updateOrCreate(
            ['clave_tipo_doc_contrato'=> 'C'],[
                'tipo_doc_contrato'=>'CONTRATO',
                'activo'=> true
            ]);
        CatTipoDocContrato::updateOrCreate(
            ['clave_tipo_doc_contrato'=> 'CM'],[
                'tipo_doc_contrato'=>'CONVENIO MODIFICATORIO',
                'activo'=> true
            ]);
    }
}
