<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosEstructuraTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_estructura', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->foreign('id')->references('id')->on('puestos_funcionales');
            $table->string('puesto_estructura', 255);

            $table->integer('id_puesto_superior')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_superior')->references('id')->on('puestos_estructura');

            $table->mediumInteger('nivel')->nullable();

            $table->integer('id_unidad_admin')->unsignedMediumInteger();
            $table->foreign('id_unidad_admin')->references('id')->on('unidades_admin');

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
        Schema::dropIfExists('puestos_estructura');
    }
}
