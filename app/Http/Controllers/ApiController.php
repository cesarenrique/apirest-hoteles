<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;

/**
 * @SWG\Swagger(
 *     basePath="",
 *     host=L5_SWAGGER_CONST_HOST,
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API REST Hoteles",
 *         description="API REST Hoteles",
 *         @SWG\Contact(
 *             email="cesarpozo25@gmail.com"
 *         )
 *     ),
 * 		@SWG\Definition(
 * 			definition="Alojamiento",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="precio", type="string", example="199,99"),
 * 			@SWG\Property(property="PensionIdentificador", type="integer", example=1),
 *      @SWG\Property(property="TipoHabitacionIdentificador", type="integer", example=1),
 *      @SWG\Property(property="TemporadaIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Cliente",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="NIF", type="string", example="49372889P"),
 * 			@SWG\Property(property="nombre", type="string", example="Rosa Vasquez"),
 *      @SWG\Property(property="email", type="string", example="rosa@gmail.com"),
 *      @SWG\Property(property="telefono", type="string", example="677777222"),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Fecha",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="fecha", type="string", example="2021-10-01"),
 * 			@SWG\Property(property="HotelIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Habitacion",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="numero", type="string", example="123"),
 * 			@SWG\Property(property="HotelIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Hotel",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="NIF", type="string", example="12345678Z"),
 * 			@SWG\Property(property="nombre", type="string", example="Reynods Hotel"),
 * 			@SWG\Property(property="LocalidadIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Localidad",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="nombre", type="string", example="Vitoria"),
 * 			@SWG\Property(property="ProvinciaIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Pension",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="tipo", type="string", example="Solo alojamiento"),
 * 			@SWG\Property(property="HotelIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Provincia",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="nombre", type="string", example="Vitoria"),
 * 			@SWG\Property(property="PaisIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Pais",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="nombre", type="string", example="España"),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Reserva",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="reservado", type="string", example="reservado"),
 * 			@SWG\Property(property="estado", type="string", example="pagado totalmente"),
 * 			@SWG\Property(property="pagado", type="string", example="199,99"),
 * 			@SWG\Property(property="AlojamientoIdentificador", type="integer", example=68),
 * 			@SWG\Property(property="HabitacionIdentificador", type="integer", example=627),
 *      @SWG\Property(property="FechaIdentificador", type="integer", example=20030),
 *      @SWG\Property(property="ClienteIdentificador", type="integer", example=699),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Tarjeta",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="numero", type="string", example="21412341241242"),
 *      @SWG\Property(property="ClienteIdentificador", type="integer", example=699),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Temporada",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="tipo", type="string", example="media"),
 * 			@SWG\Property(property="fechaInicio", type="string", example="2021-01-01"),
 * 			@SWG\Property(property="fechaFin", type="string", example="2021-06-01"),
 * 			@SWG\Property(property="HotelIdentificador", type="integer", example=68),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="TipoHabitacion",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="tipo", type="string", example="deluxe"),
 * 			@SWG\Property(property="HotelIdentificador", type="integer", example=1),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="User",
 * 			@SWG\Property(property="identificador", type="integer", description="UUID", example=1),
 * 			@SWG\Property(property="name", type="string", example="nombre apellido"),
 * 			@SWG\Property(property="email", type="string", example="abc@gmail.com"),
 *      @SWG\Property(property="esVerificado", type="string", example="0"),
 *      @SWG\Property(property="tipo_usuario", type="string", example="3"),
 *      @SWG\Property(property="fechaCreacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaActualizacion", type="string", example="2021-10-11"),
 *      @SWG\Property(property="fechaEliminacion", type="string", example="null")
 * 		),
 * 		@SWG\Definition(
 * 			definition="Errors",
 * 			@SWG\Property(property="data", type="string", description="mensaje", example="Error"),
 * 			@SWG\Property(property="code", type="Integer", example=404)
 *    ),
 * 		@SWG\Definition(
 * 			definition="Errors403",
 * 			@SWG\Property(property="data", type="string", description="mensaje", example="unauthenticated"),
 * 			@SWG\Property(property="code", type="Integer", example=403)
 *    ),
 * 		@SWG\Definition(
 * 			definition="Errors404",
 * 			@SWG\Property(property="data", type="string", description="mensaje", example="Not Found Exception"),
 * 			@SWG\Property(property="code", type="Integer", example=404)
 *    ),
 * 		@SWG\Definition(
 * 			definition="Errors406",
 * 			@SWG\Property(property="data", type="string", description="mensaje", example="Not Aceptable clients"),
 * 			@SWG\Property(property="code", type="Integer", example=406)
 *    ),
 * 		@SWG\Definition(
 * 			definition="Errors500",
 * 			@SWG\Property(property="data", type="string", description="mensaje", example="Error Interno"),
 * 			@SWG\Property(property="code", type="Integer", example=500)
 *    ),
 * )
 **/
class ApiController extends Controller
{
    use ApiResponse;
}
