<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatAlmacenesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_almacenes', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_almacen', 12);
            $table->string('almacen', 120);
            $table->string('domi_calle', 120);
            $table->string('domi_num_ext', 60);
            $table->string('domi_num_int', 60)->nullable();
            //FK
            $table->integer('id_asentamiento')->unsignedMediumInteger();
            $table->foreign('id_asentamiento')->references('id')->on('cat_asentamientos');
            // Fin FK

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
        Schema::dropIfExists('cat_almacenes');
    }
}
