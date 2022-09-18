<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdquisicionesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adquisiciones', function (Blueprint $table) {
            $table->mediumIncrements('id');
            //INICIO FK
            $table->integer('id_tipo_adquisicion')->unsignedMediumInteger()->nullable();
            $table->foreign('id_tipo_adquisicion')->references('id')->on('cat_tipo_adquisicion');
            //FIN FK
            $table->string('num_requisicion', 120)->nullable();
            //INICIO FK
            $table->integer('id_origen_recurso')->unsignedMediumInteger()->nullable();
            $table->foreign('id_origen_recurso')->references('id')->on('cat_origen_recurso');
            //FIN FK
            $table->date('fecha_adjudicacion')->nullable();
            $table->string('num_oficio_adjudicacion', 120)->nullable();
            $table->date('fecha_oficio_adjudicacion')->nullable();
            $table->string('num_carpeta', 120)->nullable();
            $table->decimal('monto_subtotal', 22, 2)->nullable();
            $table->decimal('monto_impuesto', 22, 2)->nullable();
            $table->decimal('monto_total', 22, 2)->nullable();            
            $table->mediumInteger('tiempo_entrega_dias')->nullable();
            $table->date('fecha_limite_entrega')->nullable();
            //INICIO FK
            $table->integer('id_status_adquisicion')->unsignedMediumInteger()->nullable();
            $table->foreign('id_status_adquisicion')->references('id')->on('cat_status_adquisicion');

            $table->integer('id_proveedor')->unsignedMediumInteger()->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores');

            $table->integer('id_puesto_persona')->unsignedMediumInteger()->nullable();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');
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
        Schema::dropIfExists('adquisiciones');
    }
}
