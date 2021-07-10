<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Temporada;

class TemporadaController extends ApiController
{
    public function __construct(){
      $this->middleware('client.credentials');

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * @SWG\Get(
     *   path="/temporadas",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Get Temporadas",
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *   @SWG\Response(response=200, description="successful operation",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Temporada")
     *     )
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=500, description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   ),
     *)
     *
     **/
    public function index()
    {
        $temporadas=Temporada::all();
        return $this->showAll($temporadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


               /**
               * @SWG\Post(
               *   path="/temporadas",
               *   security={
               *     {"passport": {}},
               *   },
               *   summary="Create Tarjeta for store",
               *     @SWG\Parameter(
               *         name="Autorization",
               *         in="header",
               *         required=true,
               *         type="string",
               *         description="Bearer {token_access}",
               *    ),
               *		  @SWG\Parameter(
               *          name="data",
               *          in="body",
               *          required=true,
               *          @SWG\Schema(
               *            @SWG\Property(property="tipo", type="string", example="media"),
               *            @SWG\Property(property="fecha_desde", type="string", example="2021-01-01"),
               *            @SWG\Property(property="fecha_hasta", type="string", example="2021-06-01"),
               *            @SWG\Property(property="Hotel_id", type="integer", example=1),
               *          ),
               *      ),
               *   @SWG\Response(
               *      response=201,
               *      description="Create successful operation",
               *      @SWG\Schema(ref="#definitions/Tarjeta")
               *   ),
               *   @SWG\Response(response=403, description="Autorization Exception",
               *      @SWG\Schema(ref="#definitions/Errors403")
               *   ),
               *   @SWG\Response(
               *      response=500,
               *      description="internal server error",
               *      @SWG\Schema(ref="#definitions/Errors500")
               *   )
               *)
               *
               **/
    public function store(Request $request)
    {
        $rules=[
          'tipo'=> 'required',
          'Hotel_id'=> 'required|exists:hotels,id',
          'fecha_desde'=> 'required',
          'fecha_hasta'=> 'required',
        ];

        $this->validate($request,$rules);
        $fecha_desde=(string)$request->fecha_desde;
        if(!(preg_match_all('/^(\d{4})(-)(0[1-9]|1[0-2])(-)([0-2][0-9]|3[0-1])$/',$fecha_desde))){
           return $this->errorResponse("la fecha tiene que ser formato yyyy-MM-dd y una fecha valida",401);
        }

        $fecha_hasta=(string)$request->fecha_hasta;
        if(!(preg_match_all('/^(\d{4})(-)(0[1-9]|1[0-2])(-)([0-2][0-9]|3[0-1])$/',$fecha_hasta))){
           return $this->errorResponse("la fecha tiene que ser formato yyyy-MM-dd y una fecha valida",401);
        }

        $campos=$request->all();

        $temporada=Temporada::create($campos);
        return $this->showOne($temporada,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Get(
     *   path="/temporadas/{tempora_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Get Temporada",
     *		  @SWG\Parameter(
     *          name="tempora_id",
     *          in="path",
     *          required=true,
     *          type="integer",
     *          description="un numero id"
     *      ),
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *   @SWG\Response(response=200, description="successful operation",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Temporada")
     *     )
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(response=500, description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   ),
     *)
     *
     **/
    public function show($id)
    {
        $temporada=Temporada::findOrFail($id);
        return $this->showOne($temporada);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * @SWG\Put(
     *   path="/temporadas/{tempora_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update Temporada",
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *		  @SWG\Parameter(
     *          name="tarjeta_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="un numero id"
     *      ),
     *		  @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(
     *            @SWG\Property(property="tipo", type="string", example="media"),
     *            @SWG\Property(property="fecha_desde", type="string", example="2021-01-01"),
     *            @SWG\Property(property="fecha_hasta", type="string", example="2021-06-01"),
     *            @SWG\Property(property="Hotel_id", type="integer", example=1),
     *          ),
     *      ),
     *   @SWG\Response(
     *      response=201,
     *      description="Update successful operation",
     *      @SWG\Schema(ref="#definitions/Temporada")
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(
     *      response=500,
     *      description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   )
     *)
     *
     **/

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @SWG\Delete(
     *   path="/temporadas/{tempora_id}",
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Delete Temporada",
     *		  @SWG\Parameter(
     *          name="tempora_id",
     *          in="path",
     *          required=true,
     *          type="string",
     *          description="un numero id"
     *      ),
     *     @SWG\Parameter(
     *         name="Autorization",
     *         in="header",
     *         required=true,
     *         type="string",
     *         description="Bearer {token_access}",
     *    ),
     *   @SWG\Response(response=200, description="successful operation",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref="#definitions/Reserva")
     *     )
     *   ),
     *   @SWG\Response(response=403, description="Autorization Exception",
     *      @SWG\Schema(ref="#definitions/Errors403")
     *   ),
     *   @SWG\Response(response=404, description="Not Found Exception",
     *      @SWG\Schema(ref="#definitions/Errors404")
     *   ),
     *   @SWG\Response(response=500, description="internal server error",
     *      @SWG\Schema(ref="#definitions/Errors500")
     *   ),
     *)
     *
     **/
    public function destroy($id)
    {
      $temporada=Temporada::findOrFail($id);
      $temporada->delete();
      return $this->showOne($temporada);
    }
}
