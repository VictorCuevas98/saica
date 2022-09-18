<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosCerradosDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_cerrados_detalle', function (Blueprint $table) {
            //Inicio FK
            $table->unsignedMediumInteger('id');
            $table->unsignedMediumInteger('id_artmed');
            $table->primary(['id','id_artmed']);
            $table->foreign('id')->references('id')->on('contratos_cerrados');
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');
            //Fin FK
            $table->mediumInteger('partida')->nullable();
            $table->mediumInteger('cantidad_unidades')->nullable();
            $table->decimal('monto_unitario', 22, 2)->nullable();
            $table->decimal('monto_subtotal', 22, 2)->nullable();
            $table->decimal('monto_impuesto', 22, 2)->nullable();
            $table->decimal('monto_total', 22, 2)->nullable();
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
        Schema::dropIfExists('contratos_cerrados_detalle');
    }
}
