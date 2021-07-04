<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Habitacion;
use App\Hotel;
class HabitacionFechasController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Habitacion $habitacion)
    {
        $hotel=Hotel::findOrFail($habitacion->Hotel_id);
        $fechas=$hotel->fechas;
        $reservas=$habitacion->reservas;
        $previos=collect();

        foreach ($reservas as $reserva) {

            $previos->push($reserva->Fecha_id);

        }

        $auxiliar=$previos->collect();
        $libres=collect();
        foreach ($fechas as $fecha) {
            $existe=false;

            foreach ($auxiliar as $aux) {
              if($aux==$fecha->id){
                $existe=true;
              }
            }
            if($existe==false){
              $libres->push($fecha);
            }
        }

        return $this->showAll($libres);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * En funcion de rango dice que dias esta libre una habitacion
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function libre(Request $request,$id)
    {
      $habitacion=Habitacion::findOrFail($id);
      $rules=[
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
      $hotel=Hotel::findOrFail($habitacion->Hotel_id);
      $fechas=$hotel->fechas->whereBetween('abierto',[$fecha_desde,$fecha_hasta]);
      $reservas=$habitacion->reservas;
      $previos=collect();

      foreach ($reservas as $reserva) {

          $previos->push($reserva->Fecha_id);

      }

      $auxiliar=$previos->collect();
      $libres=collect();
      foreach ($fechas as $fecha) {
          $existe=false;

          foreach ($auxiliar as $aux) {
            if($aux==$fecha->id){
              $existe=true;
            }
          }
          if($existe==false){
            $libres->push($fecha);
          }
      }

      return $this->showAll($libres);

    }

    /**
     * En funcion de rango dice que dias esta libre una habitacion
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ocupado(Request $request,$id)
    {
      $habitacion=Habitacion::findOrFail($id);
      $rules=[
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
      $hotel=Hotel::findOrFail($habitacion->Hotel_id);
      $fechas=$hotel->fechas->whereBetween('abierto',[$fecha_desde,$fecha_hasta]);
      $reservas=$habitacion->reservas;
      $previos=collect();

      foreach ($reservas as $reserva) {

          $previos->push($reserva->Fecha_id);

      }

      $auxiliar=$previos->collect();
      $ocupado=collect();
      foreach ($fechas as $fecha) {
          $existe=false;

          foreach ($auxiliar as $aux) {
            if($aux==$fecha->id){
              $existe=true;
            }
          }
          if($existe==true){
            $ocupado->push($fecha);
          }
      }

      return $this->showAll($ocupado);

    }
}