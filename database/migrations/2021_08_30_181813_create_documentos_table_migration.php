<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->integer('id_adquisicion')->unsignedMediumInteger();
            $table->foreign('id_adquisicion')->references('id')->on('adquisiciones');

            $table->integer('id_tipo_seccion')->unsignedMediumInteger();
            $table->foreign('id_tipo_seccion')->references('id')->on('cat_tipo_seccion');

            $table->integer('id_puesto_persona')->unsignedMediumInteger();
            $table->foreign('id_puesto_persona')->references('id')->on('puestos_persona');

            $table->string('filename', 120);
            $table->string('real_path', 255);
            $table->string('download_path', 255);
            $table->boolean('vigente')->nullable();
            $table->date('expired_at')->nullable();
            $table->boolean('uploaded')->nullable();
            $table->date('uploaded_at')->nullable();
            $table->string('num_documento', 200)->nullable();
            $table->boolean('activo');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();

            $table->integer('deleted_by')->unsignedMediumInteger()->nullable();
            $table->foreign('deleted_by')->references('id')->on('puestos_persona');
            
            $table->timestamp('deleted_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
