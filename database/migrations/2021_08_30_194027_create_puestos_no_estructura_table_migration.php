<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosNoEstructuraTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_no_estructura', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->foreign('id')->references('id')->on('puestos_funcionales');

            $table->string('puesto_funcional', 255);

            $table->integer('id_puesto_superior')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_superior')->references('id')->on('puestos_estructura');
            $table->mediumInteger('nivel')->nullable();
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
        Schema::dropIfExists('puestos_no_estructura');
    }
}
