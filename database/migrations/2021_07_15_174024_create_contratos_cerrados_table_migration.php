<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosCerradosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos_cerrados', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('contratos');
            $table->decimal('monto_subtotal',22 ,2 )->nullable();
            $table->decimal('monto_impuesto',22 ,2 )->nullable();
            $table->decimal('monto_total',22 ,2 )->nullable();
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
        Schema::dropIfExists('contratos_cerrados');
    }
}
