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
