<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Habitacion;
use App\TipoHabitacion;

class HabitacionController extends ApiController
{
    public function __construct(){
      $this->middleware('client.credentials');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitacion=Habitacion::all();
        return $this->showAll($habitacion);
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
    public function store(Request $request)
    {
        $rules=[
          'numero'=> 'required',
          'Hotel_id'=> 'required|exists:hotels,id',
          'tipo_habitacion_id'=> 'required|exists:tipo_habitacions,id',
        ];

        $this->validate($request,$rules);
        $campos=$request->all();
        $tipohab=TipoHabitacion::findOrFail($request->tipo_habitacion_id);
        if($tipohab->Hotel_id!=$request->Hotel_id){
           return $this->errorResponse('El id de Hotel del tipo de habitación
           debe ser mismo hotel que se desea crear la habitación',401);
        }
        $habitacion=Habitacion::create($campos);
        return $this->showOne($habitacion,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion=Habitacion::findOrFail($id);
        return $this->showOne($habitacion);
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
    public function update(Request $request, $id)
    {
        $habitacion=Habitacion::findOrFail($id);
        $rules=[
          'Hotel_id'=> 'exists:hotels,id',
          'tipo_habitacions'=> 'exists:tipo_habitacions,id',
        ];

        $this->validate($request,$rules);


        if($request->has('numero')){
          $habitacion->numero=$request->numero;
        }

        if($request->has('Hotel_id') && $request->has('tipo_habitacion_id')){
            $tipohab=TipoHabitacion::findOrFail($request->tipo_habitacion_id);
            if($tipohab->Hotel_id!=$request->Hotel_id){
               return $this->errorResponse('El id de Hotel del tipo de habitación debe ser mismo hotel que se desea crear la habitación',401);
            }
            $habitacion->Hotel_id=$request->Hotel_id;
            $habitacion->tipo_habitacion_id=$request->tipo_habitacion_id;
        }else if($request->has('Hotel_id') && !$request->has('tipo_habitacion_id')){

            $tipohab=TipoHabitacion::findOrFail($habitacion->tipo_habitacion_id);
            if($tipohab->Hotel_id!=$request->Hotel_id){
               return $this->errorResponse('El id de Hotel del tipo de habitación debe ser mismo hotel que se desea crear la habitación',401);
            }
            //este caso no pasara nunca con configuracion actual
            $habitacion->Hotel_id=$request->Hotel_id;
        }else if(!$request->has('Hotel_id') && $request->has('tipo_habitacion_id')){
            $tipohab=TipoHabitacion::findOrFail($request->tipo_habitacion_id);
            if($tipohab->Hotel_id!=$habitacion->Hotel_id){
               return $this->errorResponse('El id de Hotel del tipo de habitación debe ser mismo hotel que se desea crear la habitación',401);
            }
            $habitacion->tipo_habitacion_id=$request->tipo_habitacion_id;
        }

        if(!$habitacion->isDirty()){
           return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
        }

        $habitacion->save();
        return $this->showOne($habitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $habitacion=Habitacion::findOrFail($id);
      $habitacion->delete();
      return $this->showOne($habitacion);
    }
}
