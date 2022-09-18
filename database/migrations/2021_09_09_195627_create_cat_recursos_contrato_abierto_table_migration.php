<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatRecursosContratoAbiertoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_recursos_contrato_abierto', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_recurso_contrato_abierto', 12);
            $table->string('recurso_contrato_abierto', 120);
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
        Schema::dropIfExists('cat_recursos_contrato_abierto');
    }
}
