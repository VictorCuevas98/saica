<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosAbiertosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_abiertos', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('contratos');
            $table->decimal('monto_subtotal_minimo', 22, 2)->nullable();
            $table->decimal('monto_impuesto_minimo', 22, 2)->nullable();
            $table->decimal('monto_total_minimo', 22, 2)->nullable();
            $table->decimal('monto_subtotal_maximo', 22, 2)->nullable();
            $table->decimal('monto_impuesto_maximo', 22, 2)->nullable();
            $table->decimal('monto_total_maximo', 22, 2)->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_tipo_rango')->unsignedMediumInteger()->nullable();
            $table->foreign('id_tipo_rango')->references('id')->on('cat_tipo_rango');
            $table->boolean('recursos_disponibles');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos_abiertos');
    }
}
