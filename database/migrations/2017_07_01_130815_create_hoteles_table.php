<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id');
            $table->string('nombre_hotel');
            $table->string('categoria');
            $table->foreign('zona_id')->references('IdZona')->on('zonas');
            $table->foreign('destino_id')->references('IdDestino')->on('destinos');
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
        Schema::drop('hoteles');
    }
}
