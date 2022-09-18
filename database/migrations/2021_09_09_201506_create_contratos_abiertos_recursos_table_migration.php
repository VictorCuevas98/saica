<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosAbiertosRecursosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_abiertos_recursos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            
            $table->integer('id_contrato_abierto')->unsignedMediumInteger();
            $table->foreign('id_contrato_abierto')->references('id')->on('contratos_abiertos');

            $table->integer('id_recurso_contrato_abierto')->unsignedMediumInteger();
            $table->foreign('id_recurso_contrato_abierto')->references('id')->on('cat_recursos_contrato_abierto');

            $table->date('fecha_movimiento');
            $table->decimal('monto_subtotal_acumulado', 22, 2)->nullable();
            $table->decimal('monto_impuesto_acumulado', 22, 2)->nullable();
            $table->decimal('monto_total_acumulado', 22, 2)->nullable();
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
        Schema::dropIfExists('contratos_abiertos_recursos');
    }
}
