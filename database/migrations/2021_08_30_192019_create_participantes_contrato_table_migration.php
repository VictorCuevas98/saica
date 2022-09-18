<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesContratoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes_contrato', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_contrato')->unsignedMediumInteger();
            $table->foreign('id_contrato')->references('id')->on('contratos');

            $table->integer('id_puesto_persona')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');

            $table->text('folio')->nullable();
            $table->timestamp('fecha_firma')->nullable();
            $table->text('qr')->nullable();
            $table->text('sello')->nullable();

            $table->integer('id_tipo_participante_contrato')->unsignedMediumInteger();
            $table->foreign('id_tipo_participante_contrato')->references('id')->on('cat_tipo_participante_contrato');

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
        Schema::dropIfExists('participantes_contrato');
    }
}
