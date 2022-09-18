<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatStatusEntradaTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_status_entrada', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('clave_status_entrada', 12);
            $table->string('status_entrada', 120);
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
        Schema::dropIfExists('cat_status_entrada');
    }
}
