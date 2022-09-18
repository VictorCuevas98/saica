<?php

use Illuminate\Database\Seeder;
use App\CatTipoDocPago;

class CatTipoDocPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoDocPagoSeeder
     * @return void
     */
    public function run()
    {
        CatTipoDocPago::updateOrCreate(
            ['clave_tipo_doc_pago'=> 'REM'],[
                'tipo_doc_pago'=>'REMISIÓN',
                'activo'=> true
            ]);
        CatTipoDocPago::updateOrCreate(
            ['clave_tipo_doc_pago'=> 'FAC'],[
                'tipo_doc_pago'=>'FACTURA',
                'activo'=> true
            ]);
    }
}
