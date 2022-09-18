<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosPersonaTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_persona', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            //Inicio FK
            $table->integer('id_persona')->unsignedMediumInteger();
            $table->foreign('id_persona')->references('id')->on('personas');
            
            $table->integer('id_puesto_funcional')->unsignedMediumInteger();
            $table->foreign('id_puesto_funcional')->references('id')->on('puestos_funcionales');
            //Fin FK
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_termino')->nullable();
            //Inicio FK
            $table->char('id_tipo_desempeno', 1);
            $table->foreign('id_tipo_desempeno')->references('id')->on('cat_tipo_desempeno');
            //Fin FK

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puestos_persona');
    }
}
