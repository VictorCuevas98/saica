<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatPreguntasRevisionEntradaTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_preguntas_revision_entrada', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_pregunta', 8);
            $table->string('pregunta', 120);
            $table->mediumInteger('orden')->nullable();
            //INICIO FK
            $table->integer('id_tipo_revision')->unsignedMediumInteger();
            $table->foreign('id_tipo_revision')->references('id')->on('cat_tipo_revision');
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
        Schema::dropIfExists('cat_preguntas_revision_entrada');
    }
}
