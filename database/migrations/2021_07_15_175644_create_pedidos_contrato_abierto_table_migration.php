<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosContratoAbiertoTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_contrato_abierto', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('folio_pedido', 120);
            $table->date('fecha_pedido');
            $table->date('fecha_entrega');
            $table->decimal('monto_subtotal', 22, 2);
            $table->decimal('monto_impuesto', 22, 2);
            $table->decimal('monto_total', 22, 2);
            //Inicio FK
            $table->integer('id_contrato_abierto')->unsignedMediumInteger();
            $table->foreign('id_contrato_abierto')->references('id')->on('contratos_abiertos');
            
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
        Schema::dropIfExists('pedidos_contrato_abierto');
    }
}
