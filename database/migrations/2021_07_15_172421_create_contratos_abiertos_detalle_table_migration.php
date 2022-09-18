<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosAbiertosDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_abiertos_detalle', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->unsignedMediumInteger('id_artmed');
            $table->primary(['id','id_artmed']);
            $table->foreign('id')->references('id')->on('contratos_abiertos');
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');
            $table->mediumInteger('partida')->nullable();
            $table->decimal('monto_unitario_fijo',22 ,2 )->nullable();
            $table->mediumInteger('cantidad_unidades_minima')->nullable();
            $table->mediumInteger('cantidad_unidades_maxima')->nullable();
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
        Schema::dropIfExists('contratos_abiertos_detalle');
    }
}
