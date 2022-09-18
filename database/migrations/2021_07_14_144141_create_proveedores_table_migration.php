<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('rfc', 13);
            $table->char('tipo_persona', 1)->nullable();
            $table->string('fisica_nombre', 120)->nullable();
            $table->string('fisica_primer_ap', 60)->nullable();
            $table->string('fisica_segundo_ap', 60)->nullable();
            $table->string('razon_social', 120)->nullable();
            $table->text('representante_legal')->nullable();
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
        Schema::dropIfExists('proveedores');
    }
}
