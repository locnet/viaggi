<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas',function(Blueprint $table){
            $table->increments('id');
            $table->integer('locata');
            $table->string('nombre');
            $table->integer('telefono');
            $table->string('email');
            $table->decimal('precio');
            $table->string('control',32);
            $table->integer('adultos');
            $table->integer('menores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservas');
    }
}
