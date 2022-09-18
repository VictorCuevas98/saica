<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatUnidadesConsolidadorasTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_unidades_consolidadoras', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_unidad_consolidadora', 12);
            $table->string('unidad_consolidadora', 120);
            //Inicio FK
            $table->integer('id_orden_gobierno')->unsignedMediumInteger();
            $table->foreign('id_orden_gobierno')->references('id')->on('cat_orden_gobierno');
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
        Schema::dropIfExists('cat_unidades_consolidadoras');
    }
}
