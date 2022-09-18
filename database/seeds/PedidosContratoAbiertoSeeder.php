<?php

use Illuminate\Database\Seeder;
use App\PedidoContratoAbierto;

class PedidosContratoAbiertoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PedidosContratoAbiertoSeeder
     * @return void
     */
    public function run()
    {
        PedidoContratoAbierto::updateOrCreate(
            ['folio_pedido'=>'PCA-2021-GSOL'],[
                'fecha_pedido'=> '2021-08-17 12:36:06',
                'fecha_entrega'=> '2021-08-17 12:36:06',
                'monto_subtotal'=> 0.00,
                'monto_impuesto'=> 0.00,
                'monto_total'=> 0.00,
                'id_contrato_abierto'=> 2,
                'id_puesto_persona'=> 1,
                'id_almacen'=> 1,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:36:06'
            ]);
        PedidoContratoAbierto::updateOrCreate(
            ['folio_pedido'=>'PCA-2021-9CBJ'],[
                'fecha_pedido'=> '2021-08-17 12:36:06',
                'fecha_entrega'=> '2021-08-17 12:36:06',
                'monto_subtotal'=> 0.00,
                'monto_impuesto'=> 0.00,
                'monto_total'=> 0.00,
                'id_contrato_abierto'=> 11,
                'id_puesto_persona'=> 10,
                'id_almacen'=> 1,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:36:06'
            ]);
        PedidoContratoAbierto::updateOrCreate(
            ['folio_pedido'=>'PCA-2021-LSPT'],[
                'fecha_pedido'=> '2021-08-17 12:36:06',
                'fecha_entrega'=> '2021-08-17 12:36:06',
                'monto_subtotal'=> 0.00,
                'monto_impuesto'=> 0.00,
                'monto_total'=> 0.00,
                'id_contrato_abierto'=> 19,
                'id_puesto_persona'=> 9,
                'id_almacen'=> 1,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:36:06'
            ]);
    }
}
