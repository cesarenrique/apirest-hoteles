<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Localidad;
use App\Hotel;
use App\Pension;
use App\TipoHabitacion;
use App\Cliente;
use App\Tarjeta;
use App\Alojamiento;
use App\Fecha;
use App\Temporada;
use App\Reserva;
use App\Habitacion;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
  static $password;

  return [
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'password' => $password ?: $password = bcrypt('secret'),
      'remember_token' => Str::random(10),
      'verified'=> $verificado= $faker->randomElement([User::USUARIO_VERIFICADO,User::USUARIO_NO_VERIFICADO]),
      'verify_Token'=> $verificado== User::USUARIO_VERIFICADO ? null : User::generateVerificationToken(),
      'tipo_usuario' => $faker->randomElement([User::USUARIO_CLIENTE,User::USUARIO_EDITOR,User::USUARIO_ADMINISTRADOR]),
  ];
});

$factory->define(App\Hotel::class, function (Faker $faker) {
    $localidad= Localidad::All()->random();
    $values="";
    for($i=0;$i<8;$i++){
      $aux=$faker->randomDigit;
      $values=$values .  strval($aux);
    }
    $numero=intval($values);
    $resto=$numero%23;
    $letra=array('T','R','W','A','G','M','Y','F','P','D','X','B',
                'N','J','Z','S','Q','V','H','L','C','K','E');
    $values=$values. $letra[$resto];
    return [
      'nombre' => $faker->name,
      'NIF' => $values,
      'Localidad_id'=> $localidad->id,
    ];
});
$factory->define(App\Pension::class, function (Faker $faker) {
    $hotel=Hotel::All()->random();
    return [
       'tipo'=> $faker->randomElement([Pension::PENSION_DESAYUNO,Pension::PENSION_COMPLETA,Pension::PENSION_COMPLETA_CENA]),
       'Hotel_id'=>$hotel->id,
    ];
});

$factory->define(App\TipoHabitacion::class, function (Faker $faker) {
    $hotel=Hotel::All()->random();
    return [
       'tipo'=> $faker->randomElement([TipoHabitacion::HABITACION_SIMPLE,TipoHabitacion::HABITACION_DOBLE,TipoHabitacion::HABITACION_MATRIMONIAL]),
       'Hotel_id'=>$hotel->id,
    ];
});

$factory->define(App\Habitacion::class, function (Faker $faker) {
    $hotel= Hotel::All()->random();
    $tipo= $faker->randomElement(TipoHabitacion::where('Hotel_id',$hotel->id)->get());
    $numero=0;
    $numero=$faker->numberBetween($min=1,$max=400);
    $ceros="";
    if($numero<10) $ceros="00";
    if(10<$numero && $numero<100) $ceros="0";
    $numero2=$ceros.$numero;
    return [
       'numero'=> $numero2,
       'Hotel_id'=> $hotel->id,
       'tipo_habitacion_id'=> $tipo->id,
     ];
});

$factory->define(App\Cliente::class, function (Faker $faker) {
  $values="";
  for($i=0;$i<8;$i++){
    $aux=$faker->randomDigit;
    $values=$values .  strval($aux);
  }
  $numero=intval($values);
  $resto=$numero%23;
  $letra=array('T','R','W','A','G','M','Y','F','P','D','X','B',
              'N','J','Z','S','Q','V','H','L','C','K','E');
  $values=$values. $letra[$resto];

  return [
     'NIF'=> $values,
     'nombre'=> $faker->name,
     'email'=> $faker->unique()->email,
     'telefono'=> $faker->phoneNumber,

  ];
});
$factory->define(App\Tarjeta::class, function (Faker $faker) {
    $cliente=Cliente::All()->random();

    return [
       'numero'=> $faker->creditCardNumber,
       'Cliente_id'=> $cliente->id,

    ];
});

$factory->define(App\Reserva::class, function (Faker $faker) {
    $tarjeta=Tarjeta::All()->random();
    $cliente=Cliente::find($tarjeta->Cliente_id);
    $habitacion=Habitacion::All()->random();
    $temporada=Temporada::where('Hotel_id',$habitacion->Hotel_id)->get()->random();
    $fecha=Fecha::where('Hotel_id',$habitacion->Hotel_id)
            ->whereBetween('abierto',[$temporada->fecha_desde,$temporada->fecha_hasta])
            ->get()->random();
    $pension=Pension::where('Hotel_id',$habitacion->Hotel_id)->get()->random();

    $alojamiento=Alojamiento::where('Temporada_id',$temporada->id)
      ->where('Pension_id',$pension->id)
      ->where('tipo_habitacion_id',$habitacion->tipo_habitacion_id)
      ->get()->random();
    return [

      'reservado'=> Reserva::RESERVADO,
      'estado'=> Reserva::PAGADO_TOTALMENTE,
      'pagado'=> $alojamiento->precio,
      'Fecha_id'=> $fecha->id,
      'Alojamiento_id'=> $alojamiento->id,
      'Habitacion_id'=> $habitacion->id,
      'Cliente_id'=>$cliente->id,

    ];
});
