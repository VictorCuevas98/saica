<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesAdminTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_admin', function (Blueprint $table) {
            $table->mediumIncrements('id')->comment('Identificador de la unidad administrativa.');
            $table->string('clave_uniadm', 20)->nullable()->comment('Clave de la unidad administrativa. [ SAF | SEDUVI | SEDEMA | ...]');
            $table->string('unidad_admin', 200)->comment('Descripción de la unidad administrativa.');
            $table->timestamp('created_at')->comment('Fecha de creación del registro.');
            $table->timestamp('updated_at')->nullable()->comment('Fecha de actualización del registro.');
            
            $table->string('logo', 255)->nullable();
            $table->string('email', 255)->nullable()->comment('Correo de la unidad administrativa.');
            $table->string('telefono', 60)->nullable()->comment('Teléfono de la oficina principal de la unidad administrativa.');
            $table->string('calle', 120)->nullable()->comment('Nombre de la calle donde se ubica la unidad administrativa.');
            $table->string('num_ext', 120)->nullable()->comment('Número exterior de la unidad.');
            $table->string('num_int', 80)->nullable()->comment('Número interior de la unidad.');
            //Inicio FK
            $table->integer('id_asentamiento')->unsignedMediumInteger()->nullable();
            $table->foreign('id_asentamiento')->references('id')->on('cat_asentamientos');
            //Fin FK
            $table->string('ext_tel', 32)->nullable()->comment('Extensión telefonica de la unidad administrativa.');
            //Inicio FK
            $table->integer('id_ente_publico')->unsignedMediumInteger();
            $table->foreign('id_ente_publico')->references('id')->on('entes_publicos');
            //Fin FK
            $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades_admin');
    }
}
