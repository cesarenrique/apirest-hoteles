<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->bigInteger('Hotel_id')->unsigned();
            $table->bigInteger('tipo_habitacion_id')->unsigned();
            $table->foreign('Hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('tipo_habitacion_id')->references('id')->on('tipo_habitacions')->onDelete('cascade');
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
        Schema::dropIfExists('habitacions');
    }
}
