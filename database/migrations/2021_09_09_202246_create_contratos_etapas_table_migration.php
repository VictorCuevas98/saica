<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosEtapasTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_etapas', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_contrato')->unsignedMediumInteger();
            $table->foreign('id_contrato')->references('id')->on('contratos');
            
            $table->integer('id_etapa_contrato')->unsignedMediumInteger();
            $table->foreign('id_etapa_contrato')->references('id')->on('cat_etapas_contrato');

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
        Schema::dropIfExists('contratos_etapas');
    }
}
