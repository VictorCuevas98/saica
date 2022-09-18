<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->mediumIncrements('id');
            
            //Inicio FK
            $table->integer('id_tipo_entrada')->unsignedMediumInteger();
            $table->foreign('id_tipo_entrada')->references('id')->on('cat_tipo_entrada');
            //Fin FK
            $table->string('folio_entrada', 120);
            $table->date('fecha_entrada');
            //Inicio FK
            $table->integer('id_puesto_persona')->unsignedMediumInteger();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');
            
            $table->integer('id_almacen')->unsignedMediumInteger();
            $table->foreign('id_almacen')->references('id')->on('cat_almacenes');

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
        Schema::dropIfExists('entradas');
    }
}
