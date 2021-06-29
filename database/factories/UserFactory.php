<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Localidad;
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
      'verification_token'=> $verificado== User::USUARIO_VERIFICADO ? null : User::generateVerificationToken(),
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
