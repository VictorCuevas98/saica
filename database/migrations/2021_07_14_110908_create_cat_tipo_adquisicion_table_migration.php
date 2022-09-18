<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatTipoAdquisicionTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_tipo_adquisicion', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_tipo_adquisicion', 12);
            $table->string('tipo_adquisicion', 120);
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
        Schema::dropIfExists('cat_tipo_adquisicion');
    }
}
