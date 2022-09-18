<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesSolicitudAbastecimientoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes_solicitud_abastecimiento', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_solicitud_abastecimiento')->unsignedMediumInteger();
            $table->foreign('id_solicitud_abastecimiento')->references('id')->on('solicitudes_abastecimiento');

            $table->integer('id_tipo_participante_solicitud_abastecimiento')->unsignedMediumInteger();
            $table->foreign('id_tipo_participante_solicitud_abastecimiento')->references('id')->on('cat_tipo_participante_solicitud_abastecimiento');

            $table->integer('id_puesto_persona')->unsignedMediumInteger();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');

            $table->text('folio')->nullable();
            $table->timestamp('fecha_firma')->nullable();
            $table->text('qr')->nullable();
            $table->text('sello')->nullable();
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
        Schema::dropIfExists('participantes_solicitud_abastecimiento');
    }
}
