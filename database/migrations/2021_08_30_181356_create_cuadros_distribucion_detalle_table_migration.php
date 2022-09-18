<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuadrosDistribucionDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadros_distribucion_detalle', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->integer('id_artmed')->unsignedMediumInteger();
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');
            $table->mediumInteger('cantidad_unidades');
            $table->integer('id_cuadro_distribucion')->unsignedMediumInteger();
            $table->foreign('id_cuadro_distribucion')->references('id')->on('cuadros_distribucion');
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
        Schema::dropIfExists('cuadros_distribucion_detalle');
    }
}
