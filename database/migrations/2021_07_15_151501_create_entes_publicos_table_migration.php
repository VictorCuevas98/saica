<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntesPublicosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entes_publicos', function (Blueprint $table) {
            $table->mediumIncrements('id')->comment('Identificador del ente publico.');
            $table->string('ente_publico', 255)->comment('Nombre del ente público.');
            $table->string('clave_entpub', 20)->nullable()->comment('Siglas del ente público.');
            $table->string('domi_calle', 120)->nullable()->comment('Calle del domicilio de la oficina principal del ente público.');
            $table->string('domi_numext', 100)->nullable()->comment('Número exterior del domicilio de la oficina principal del ente público.');
            $table->string('domi_numint', 80)->nullable()->comment('Número interior del domicilio de la oficina principal del ente público.');
            //INICIO FK
            $table->integer('id_asentamiento')->unsignedMediumInteger()->nullable()->comment('Identificador de la colonia.');
            $table->foreign('id_asentamiento')->references('id')->on('cat_asentamientos');
            //FIN FK 
            $table->string('telefono', 60)->nullable()->comment('Teléfono de la oficina principal del ente público.');
            $table->string('ext_tel', 32)->nullable()->comment('Extensión del teléfono del ente público.');
            $table->boolean('activo')->comment('Si este ente se encuentra visible en el sistema o no.');
            $table->timestamp('created_at')->comment('Fecha de creación del registro.');
            $table->timestamp('updated_at')->nullable()->comment('Fecha de modificacion del registro.');
            $table->mediumInteger('id_i4ch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entes_publicos');
    }
}
