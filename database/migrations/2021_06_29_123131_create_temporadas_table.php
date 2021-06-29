<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->Integer('dia_desde');
            $table->Integer('mes_desde');
            $table->Integer('anyo_desde');
            $table->Integer('dia_hasta');
            $table->Integer('mes_hasta');
            $table->Integer('anyo_hasta');
            $table->bigInteger('Hotel_id')->unsigned();
            $table->foreign('Hotel_id')->references('id')->on('hotels');
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
        Schema::dropIfExists('temporadas');
    }
}
