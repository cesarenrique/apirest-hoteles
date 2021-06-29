<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Reserva;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reservado')->default(Reserva::LIBRE);
            $table->string('estado');
            $table->string('pagado');
            $table->bigInteger('Fecha_id')->unsigned();
            $table->bigInteger('Alojamiento_id')->unsigned();
            $table->bigInteger('Habitacion_id')->unsigned();
            $table->bigInteger('Cliente_id')->unsigned()->nullable();
            $table->foreign('Fecha_id')->references('id')->on('fechas');
            $table->foreign('Alojamiento_id')->references('id')->on('alojamientos');
            $table->foreign('Habitacion_id')->references('id')->on('habitacions');
            $table->foreign('Cliente_id')->references('id')->on('clientes');
            $table->unique(['Fecha_id','Habitacion_id','Alojamiento_id']);
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
        Schema::dropIfExists('reservas');
    }
}
