<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasAdquisicionTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_adquisicion', function (Blueprint $table) {
            $table->primary('id');
            $table->unsignedMediumInteger('id');
            $table->foreign('id')->references('id')->on('entradas');

            $table->decimal('monto_subtotal', 22,2);
            $table->decimal('monto_impuesto', 22,2);
            $table->decimal('monto_total', 22,2);

            $table->integer('id_adquisicion_doc_pago')->unsignedMediumInteger();
            $table->foreign('id_adquisicion_doc_pago')->references('id')->on('adquisiciones_doc_pago');

            $table->integer('id_pedido_contrato_abierto')->unsignedMediumInteger()->nullable();
            $table->foreign('id_pedido_contrato_abierto')->references('id')->on('pedidos_contrato_abierto');

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
        Schema::dropIfExists('entradas_adquisicion');
    }
}
