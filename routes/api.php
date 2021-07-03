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
Route::resource('localidades',LocalidadController::class,['only'=>['index','show']]);
Route::resource('users',UserController::class,['except'=>['create','edit']]);
Route::resource('hotels',HotelController::class,['except'=>['create','edit']]);
Route::resource('pensions',PensionController::class,['except'=>['create','edit']]);
