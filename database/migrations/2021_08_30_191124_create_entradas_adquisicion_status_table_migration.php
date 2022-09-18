<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasAdquisicionStatusTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_adquisicion_status', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_entrada')->unsignedMediumInteger();
            $table->foreign('id_entrada')->references('id')->on('entradas_adquisicion');

            $table->integer('id_status_entrada')->unsignedMediumInteger();
            $table->foreign('id_status_entrada')->references('id')->on('cat_status_entrada');

            $table->integer('id_puesto_persona')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');

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
        Schema::dropIfExists('entradas_adquisicion_status');
    }
}
