<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlojamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alojamientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('Pension_id')->unsigned();
            $table->bigInteger('tipo_habitacion_id')->unsigned();
            $table->bigInteger('Temporada_id')->unsigned();
            $table->unique(['Pension_id','tipo_habitacion_id','Temporada_id']);
            $table->String('precio');
            $table->foreign('Pension_id')->references('id')->on('pensions');
            $table->foreign('tipo_habitacion_id')->references('id')->on('tipo_habitacions');
            $table->foreign('Temporada_id')->references('id')->on('temporadas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alojamientos');
    }
}
