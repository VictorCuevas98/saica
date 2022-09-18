<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosFuncionalesTempTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos_funcionales_temp', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->mediumInteger('id_tipo_contratacion');
            $table->string('puesto_funcional', 255);
            $table->mediumInteger('id_puesto_superior')->nullable();
            $table->mediumInteger('nivel')->nullable();
            $table->mediumInteger('id_unidad_admin');
            $table->boolean('activo')->nullable();
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
        Schema::dropIfExists('puestos_funcionales_temp');

        
    }
}
