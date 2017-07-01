<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours',function(Blueprint $table){
            $table->increments('id');
            $table->integer('destino')->references('IdDestino')->on('destinos');
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('start');
            $table->string('fin');
            $table->text('dias');
            $table->string('hoteles');
            $table->string('idhoteles');
            $table->string('foto');
            $table->string('pdfa');
            $table->string('pdfp');
            $table->string('precio');
            $table->string('preciopublico');
            $table->string('visible',5);
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
        Schema::drop('tours');
    }
}
