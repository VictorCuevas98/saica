<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesAbastecimientoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_abastecimiento', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->char('id_tipo_solicitud_abastecimiento')->unsignedMediumInteger();
            $table->foreign('id_tipo_solicitud_abastecimiento')->references('id')->on('cat_tipos_solicitud_abastecimiento');

            $table->integer('id_periodo')->unsignedMediumInteger();
            $table->foreign('id_periodo')->references('id')->on('cat_periodos');

            $table->string('num_solicitud_abastecimiento', 120)->nullable();

            $table->integer('destinatario_id_almacen')->unsignedMediumInteger();
            $table->foreign('destinatario_id_almacen')->references('id')->on('cat_almacenes');

            $table->integer('remitente_id_unidad_admin')->unsignedMediumInteger();
            $table->foreign('remitente_id_unidad_admin')->references('id')->on('unidades_admin');

            $table->integer('remitente_id_puesto_persona')->unsignedMediumInteger();
            $table->foreign('remitente_id_puesto_persona')->references('id')->on('puestos_persona');

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
        Schema::dropIfExists('solicitudes_abastecimiento');
    }
}
