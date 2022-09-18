<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitaciones', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('num_licitacion', 120)->nullable();
            //Inicio FK
            $table->integer('id_unidad_consolidadora')->unsignedMediumInteger()->nullable();
            $table->foreign('id_unidad_consolidadora')->references('id')->on('cat_unidades_consolidadoras');

            $table->integer('id_adquisicion')->unsignedMediumInteger();
            $table->foreign('id_adquisicion')->references('id')->on('adquisiciones');
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
        Schema::dropIfExists('licitaciones');
    }
}
