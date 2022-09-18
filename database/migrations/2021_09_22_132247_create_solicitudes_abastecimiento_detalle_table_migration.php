<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesAbastecimientoDetalleTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_abastecimiento_detalle', function (Blueprint $table) {
            $table->primary(['id','id_artmed']);
            $table->unsignedMediumInteger('id');           
            $table->unsignedMediumInteger('id_artmed');        
            
            $table->foreign('id')->references('id')->on('solicitudes_abastecimiento');
            $table->foreign('id_artmed')->references('id')->on('cat_artmed');

            $table->mediumInteger('cantidad_unidades_solicitada');
            $table->mediumInteger('cantidad_unidades_autorizada');
            $table->mediumInteger('cantidad_unidades_otorgada');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('solicitudes_abastecimiento_detalle');
    }
}
