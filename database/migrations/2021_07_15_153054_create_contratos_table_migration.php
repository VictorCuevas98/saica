<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //INICIO FK
            $table->integer('id_tipo_contrato')->unsignedMediumInteger();
            $table->foreign('id_tipo_contrato')->references('id')->on('cat_tipo_contrato');

            $table->integer('id_tipo_doc_contrato')->unsignedMediumInteger()->nullable();
            $table->foreign('id_tipo_doc_contrato')->references('id')->on('cat_tipo_doc_contrato');    
            //FIN FK
            $table->string('num_contrato', 120);
            $table->date('fecha_contrato')->nullable();

            //INICIO FK
            $table->integer('id_adquisicion')->unsignedMediumInteger();
            $table->foreign('id_adquisicion')->references('id')->on('adquisiciones');
            //FIN FK
            $table->boolean('validado');
            $table->boolean('activo');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->text('observaciones')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
