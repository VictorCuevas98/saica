<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdquisicionesDocPagoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisiciones_doc_pago', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //INICIO FK
            $table->integer('id_tipo_doc_pago')->unsignedMediumInteger();
            $table->foreign('id_tipo_doc_pago')->references('id')->on('cat_tipo_doc_pago');
            //FIN FK
            $table->string('num_doc_pago', 80);
            $table->decimal('monto_subtotal', 22, 2)->nullable();
            $table->decimal('monto_impuesto', 22, 2)->nullable();
            $table->decimal('monto_total', 22, 2)->nullable();
            //INICIO FK
            $table->integer('id_adquisicion')->unsignedMediumInteger();
            $table->foreign('id_adquisicion')->references('id')->on('adquisiciones');
            //FIN FK
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
        Schema::dropIfExists('adquisiciones_doc_pago');
    }
}
