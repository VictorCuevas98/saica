<?php

use Illuminate\Database\Seeder;
use App\CatEtapasPedido;

class CatEtapasPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatEtapasPedidoSeeder
     * @return void
     */
    public function run()
    {
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'PRO'],[
                'etapa_pedido'=>'EN PROCESO',
                'activo'=> true
            ]);
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'REV'],[
                'etapa_pedido'=>'EN ESPERA DEL PROVEEDOR',
                'activo'=> true
            ]);
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'RCH'],[
                'etapa_pedido'=>'ACEPTADO ESPERANDO ENTREGA',
                'activo'=> true
            ]);
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'APR'],[
                'etapa_pedido'=>'DETENIDO',
                'activo'=> true
            ]);
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'CON'],[
                'etapa_pedido'=>'CONCLUIDO',
                'activo'=> true
            ]);
        CatEtapasPedido::updateOrCreate(
            ['clave_etapa_pedido'=> 'CAN'],[
                'etapa_pedido'=>'CANCELADO',
                'activo'=> true
            ]);
    }
}
