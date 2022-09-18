<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosCerradosAbastecimientoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_cerrados_abastecimiento', function (Blueprint $table) {
            $table->primary(['id','id_artmed','id_almacen','fecha_inicio']);
            $table->unsignedMediumInteger('id');
            $table->unsignedMediumInteger('id_artmed');;
            //$table->foreign('id_contrato_abierto')->references('id')->on('contratos_abiertos_detalle');
            $table->foreign(['id','id_artmed'])->references(['id','id_artmed'])->on('contratos_cerrados_detalle');

            $table->integer('id_almacen')->unsignedMediumInteger();
            $table->foreign('id_almacen')->references('id')->on('cat_almacenes');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->mediumInteger('cantidad_unidades')->nullable();
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
        Schema::dropIfExists('contratos_cerrados_abastecimiento');
    }
}
