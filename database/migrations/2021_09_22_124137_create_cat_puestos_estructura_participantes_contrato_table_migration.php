<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatPuestosEstructuraParticipantesContratoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_puestos_estructura_participantes_contrato', function (Blueprint $table) {
            
            $table->primary(['id_tipo_participante_contrato','id_puesto_estructura']);
            $table->unsignedMediumInteger('id_tipo_participante_contrato');
            $table->foreign('id_tipo_participante_contrato')->references('id')->on('cat_tipo_participante_contrato');
            $table->unsignedMediumInteger('id_puesto_estructura');
            $table->foreign(['id_puesto_estructura'])->references(['id'])->on('puestos_estructura');
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
        Schema::dropIfExists('cat_puestos_estructura_participantes_contrato');
    }
}
