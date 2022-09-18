<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosNoEstructuraAdscripcionTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_no_estructura_adscripcion', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->integer('id_puesto_no_estructura')->unsignedMediumInteger();
            $table->foreign('id_puesto_no_estructura')->references('id')->on('puestos_no_estructura');

            $table->integer('id_unidad_admin')->unsignedMediumInteger();
            $table->foreign('id_unidad_admin')->references('id')->on('unidades_admin');
            
            $table->date('fecha_adscripcion');
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
        Schema::dropIfExists('puestos_no_estructura_adscripcion');
    }
}
