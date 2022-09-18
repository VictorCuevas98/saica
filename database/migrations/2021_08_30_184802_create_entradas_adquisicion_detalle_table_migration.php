<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasAdquisicionDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_adquisicion_detalle', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //Inicio FK
            $table->integer('id_artmed')->unsignedMediumInteger();
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');
            //Fin FK
            $table->mediumInteger('cantidad_unidades');
            $table->string('num_lote', 30);
            $table->date('fecha_caducidad')->nullable();
            //Inicio FK
            $table->integer('id_laboratorio')->unsignedMediumInteger()->nullable();
            $table->foreign('id_laboratorio')->references('id')->on('cat_laboratorio');
            //Fin FK
            $table->decimal('monto_unitario', 22, 2);
            $table->decimal('monto_subtotal', 22, 2);
            $table->decimal('monto_impuesto', 22, 2)->nullable();
            $table->decimal('monto_total', 22, 2)->nullable();
            //Inicio FK
            $table->integer('id_entrada')->unsignedMediumInteger();
            $table->foreign('id_entrada')->references('id')->on('entradas');
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
        Schema::dropIfExists('entradas_adquisicion_detalle');
    }
}
