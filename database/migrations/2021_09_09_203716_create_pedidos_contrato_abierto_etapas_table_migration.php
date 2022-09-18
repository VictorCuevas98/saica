<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosContratoAbiertoEtapasTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_contrato_abierto_etapas', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_pedido_contrato_abierto')->unsignedMediumInteger();
            $table->foreign('id_pedido_contrato_abierto')->references('id')->on('pedidos_contrato_abierto');

            $table->integer('id_etapa_pedido')->unsignedMediumInteger();
            $table->foreign('id_etapa_pedido')->references('id')->on('cat_etapas_pedido');

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
        Schema::dropIfExists('pedidos_contrato_abierto_etapas');
    }
}
