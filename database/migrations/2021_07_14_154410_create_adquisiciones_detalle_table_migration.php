<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdquisicionesDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisiciones_detalle', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //INICIO FK
            $table->integer('id_artmed')->unsignedMediumInteger();
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');
            //FIN FK
            $table->mediumInteger('cantidad_unidades')->nullable();
            $table->decimal('monto_unitario', 22, 2)->nullable();
            $table->decimal('monto_subtotal', 22, 2)->nullable();
            $table->decimal('monto_impuesto', 22, 2)->nullable();
            $table->decimal('monto_total', 22, 2)->nullable();
            //INICIO FK
            $table->integer('id_adquisicion')->unsignedMediumInteger();
            $table->foreign('id_adquisicion')->references('id')->on('adquisiciones');
            //FIN FK                       
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
        Schema::dropIfExists('adquisiciones_detalle');
    }
}
