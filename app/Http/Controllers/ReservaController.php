<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Reserva;
use App\Fecha;
use App\Alojamiento;
use App\Habitacion;
use App\Pension;

class ReservaController extends ApiController
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
        $reservas=Reserva::all();
        return $this->showAll($reservas);
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
        'Fecha_id'=> 'required|exists:fechas,id',
        'Habitacion_id'=> 'required|exists:habitacions,id',
        'Alojamiento_id' => 'required|exists:alojamientos,id',
        'Cliente_id'=> 'required|exists:clientes,id',
        'Tarjeta' => "min:15",
      ];
      $this->validate($request,$rules);
      $campos=$request->all();
      $campos['reservado']=Reserva::RESERVADO;
      $campos['estado']=RESERVA::PAGADO_TOTALMENTE;

      $fecha=Fecha::findOrFail($request->Fecha_id);
      $habitacion=Habitacion::findOrFail($request->Habitacion_id);
      $alojamiento=Alojamiento::findOrFail($request->Alojamiento_id);
      $pension=Pension::findOrFail($alojamiento->Pension_id);
      if(!($fecha->Hotel_id==$habitacion->Hotel_id && $fecha->Hotel_id==$pension->Hotel_id)){
        return $this->errorResponse('Fecha_id, Habitacion_id, Alojamiento_id deben ser del mismo hotel',405);
      }

      $campos['pagado']=$alojamiento->precio;

      DB::transaction(function () use($campos) {
          Reserva::create($campos);

      });
      $reserva_previo=Reserva::where('Cliente_id',$request->Cliente_id)
       ->where('Alojamiento_id',$request->Alojamiento_id)
       ->where('Habitacion_id',$request->Habitacion_id)
       ->where('Fecha_id',$request->Fecha_id)->get();

       if($reserva_previo->isEmpty()){
         return errorResponse("Reserva no encontrada",405);
       }
       $reserva=$reserva_previo->first();
       return $this->showOne($reserva,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserva=Reserva::findOrFail($id);
        return $this->showOne($reserva);
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
      $reserva=Reserva::findOrFail($id);
      $rules=[
        'Cliente_id'=> 'exists:clientes,id',
      ];
      $this->validate($request,$rules);

      if($request->has('Cliente_id')){
          $reserva->Cliente_id=$request->Cliente_id;
      }

      if(!$reserva->isDirty()){
         return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
      }

      $reserva->saveOrFail();

      return $this->showOne($reserva);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $reserva=Reserva::findOrFail($id);
      $reserva->forceDelete();
      return $this->showOne($reserva);
    }
}
