<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuadrosDistribucionTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadros_distribucion', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->integer('id_ejercicio_fiscal')->unsignedMediumInteger();
            $table->foreign('id_ejercicio_fiscal')->references('id')->on('cat_ejercicios_fiscales');
            $table->integer('id_unidad_admin')->unsignedMediumInteger();
            $table->foreign('id_unidad_admin')->references('id')->on('unidades_admin');
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
        Schema::dropIfExists('cuadros_distribucion');
    }
}
