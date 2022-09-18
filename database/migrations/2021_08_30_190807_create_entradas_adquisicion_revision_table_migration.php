<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasAdquisicionRevisionTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_adquisicion_revision', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //Inicio FK
            $table->integer('id_entrada')->unsignedMediumInteger();
            $table->foreign('id_entrada')->references('id')->on('entradas');

            $table->integer('id_pregunta')->unsignedMediumInteger();
            $table->foreign('id_pregunta')->references('id')->on('cat_preguntas_revision_entrada');
            //Fin FK
            $table->boolean('respuesta');
            //Inicio FK
            $table->integer('id_puesto_persona')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');
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
        Schema::dropIfExists('entradas_adquisicion_revision');
    }
}
