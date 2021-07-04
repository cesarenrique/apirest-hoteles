<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('pais',PaisController::class,['only'=>['index','show']]);
Route::resource('provincias',ProvinciaController::class,['only'=>['index','show']]);
Route::resource('localidads',LocalidadController::class,['only'=>['index','show']]);
Route::resource('users',UserController::class,['except'=>['create','edit']]);
Route::resource('hotels',HotelController::class,['except'=>['create','edit']]);
Route::resource('pensions',PensionController::class,['except'=>['create','edit']]);
Route::resource('tipo_habitacions',TipoHabitacionController::class,['except'=>['create','edit']]);
Route::resource('hotels.pensions',HotelPensionController::class,['only'=>['index']]);
Route::resource('pais.hotels',PaisHotelController::class,['only'=>['index']]);
Route::resource('provincias.hotels',ProvinciaHotelController::class,['only'=>['index']]);
Route::resource('localidads.hotels',LocalidadHotelController::class,['only'=>['index']]);
Route::resource('hotels.tipo_habitacions',HotelTipoHabitacionController::class,['only'=>['index']]);
Route::resource('habitacions',HabitacionController::class,['except'=>['create','edit']]);
Route::resource('hotels.habitacions',HotelHabitacionController::class,['only'=>['index']]);
Route::resource('tipo_habitacions.habitacions',TipoHabitacionHabitacionController::class,['only'=>['index']]);
Route::resource('temporadas',TemporadaController::class,['except'=>['create','edit','update']]);
Route::resource('alojamientos',AlojamientoController::class,['except'=>['create','edit','store']]);
Route::get('hotels/{hotel}/alojamientos/generar','HotelAlojamientoController@generar');
Route::resource('hotels.alojamientos',HotelAlojamientoController::class,['except'=>['create','edit','store','update','destroy']]);
Route::get('hotels/{hotel}/fechas/abrir','HotelFechaController@abrir');
Route::get('hotels/{hotel}/fechas/cerrar','HotelFechaController@cerrar');
Route::resource('hotels.fechas',HotelFechaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('clientes',ClienteController::class,['except'=>['create','edit']]);
Route::resource('tarjetas',TarjetaController::class,['except'=>['create','edit']]);
Route::resource('clientes.tarjetas',ClienteTarjetaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('reservas',ReservaController::class,['except'=>['create','edit']]);
Route::resource('clientes.reservas',ClienteReservaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('hotels.reservas',HotelReservaController::class,['except'=>['create','edit','store','update','destroy']]);
Route::get('habitacions/{hotel}/fechas/libre','HabitacionFechasController@libre');
Route::get('habitacions/{hotel}/fechas/ocupado','HabitacionFechasController@ocupado');
Route::resource('habitacions.fechas',HabitacionFechasController::class,['except'=>['create','edit','store','update','destroy']]);
Route::resource('habitacions.alojamientos',HabitacionAlojamientoController::class,['except'=>['create','edit','store','update','destroy']]);
