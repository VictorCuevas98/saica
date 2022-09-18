<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatTipoParticipanteSolicitudAbastecimientoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_tipo_participante_solicitud_abastecimiento', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_tipo_participante_solicitud_abastecimiento', 5);
            $table->string('tipo_participante_solicitud_abastecimiento', 100);
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
        Schema::dropIfExists('cat_tipo_participante_solicitud_abastecimiento');
    }
}
