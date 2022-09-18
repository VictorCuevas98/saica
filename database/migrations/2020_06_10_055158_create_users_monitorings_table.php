<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersMonitoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         /*Schema::create('users_monitorings', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('id_users')->nullable();
             $table->string('token',200);
             $table->integer('login')->nullable();
             $table->integer('result')->nullable();
             $table->timestamps();
         });*/
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         //Schema::dropIfExists('users_monitorings');
     }
}
