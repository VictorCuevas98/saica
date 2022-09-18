<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosDetalleContratoAbiertoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_detalle_contrato_abierto', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->unsignedMediumInteger('id_contrato_abierto');
            $table->unsignedMediumInteger('id_artmed');
            //$table->foreign('id_contrato_abierto')->references('id')->on('contratos_abiertos_detalle');
            $table->foreign(['id_contrato_abierto', 'id_artmed'])->references(['id','id_artmed'])->on('contratos_abiertos_detalle');

            $table->mediumInteger('cantidad_unidades')->nullable();
            $table->decimal('monto_unitario', 22, 2)->nullable();
            $table->decimal('monto_subtotal', 22, 2);
            $table->decimal('monto_impuesto', 22, 2);
            $table->decimal('monto_total', 22, 2);
            //Inicio FK
            $table->integer('id_pedido_contrato_abierto')->unsignedMediumInteger();
            $table->foreign('id_pedido_contrato_abierto')->references('id')->on('pedidos_contrato_abierto');
            //Fin FK
            $table->boolean('activo');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_detalle_contrato_abierto');
    }
}
