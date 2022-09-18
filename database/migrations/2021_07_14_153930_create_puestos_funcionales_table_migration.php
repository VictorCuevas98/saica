<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosFuncionalesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_funcionales', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //Inicio FK
            $table->integer('id_tipo_contratacion')->unsignedMediumInteger();
            $table->foreign('id_tipo_contratacion')->references('id')->on('cat_tipo_contratacion');
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
        Schema::dropIfExists('puestos_funcionales');
    }
}
