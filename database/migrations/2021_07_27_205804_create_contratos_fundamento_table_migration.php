<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosFundamentoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_fundamento', function (Blueprint $table) {
            $table->primary(['id_contrato','id_fundamento_legal']);
            $table->unsignedMediumInteger('id_contrato');           
            $table->unsignedMediumInteger('id_fundamento_legal');        
            
            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->foreign('id_fundamento_legal')->references('id')->on('cat_fundamento_legal');

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
        Schema::dropIfExists('contratos_fundamento');
    }
}
