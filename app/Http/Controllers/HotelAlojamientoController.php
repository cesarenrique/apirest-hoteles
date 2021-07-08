<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use App\Hotel;
use App\Alojamiento;

class HotelAlojamientoController extends ApiController
{

    public function __construct(){
      $this->middleware('client.credentials');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($Hotel_id)
    {
      $hotel=Hotel::findOrFail($Hotel_id);
      $pensiones=$hotel->pensions;
      $previo=collect();
      foreach($pensiones as $pension){
        $previo->push($pension->alojamientos);
      }
      $alojamientos=$previo->collapse();
      return $this->showAll($alojamientos);
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
     * Genera tabla de precios
     *
     * @return \Illuminate\Http\Response
     */
    public function generar($Hotel_id)
    {
        $hotel=Hotel::findOrFail($Hotel_id);
        $alojamientos=DB::select("select p.id 'Pension_id',th.id 'tipo_habitacion_id',t.id 'Temporada_id', p.Hotel_id
            from pensions p, tipo_habitacions th, temporadas t
              where p.Hotel_id =t.Hotel_id and th.Hotel_id=t.Hotel_id and p.Hotel_id =th.Hotel_id  and p.Hotel_id=".$hotel->id);



        foreach ($alojamientos as $alojamiento) {
            $cantidad=DB::select("select count(*) as 'cantidad' from alojamientos a where a.Pension_id=".$alojamiento->Pension_id." and a.tipo_habitacion_id=".$alojamiento->tipo_habitacion_id." and a.Temporada_id=".$alojamiento->Temporada_id." and a.deleted_at is null");

            if($cantidad[0]->cantidad==0){
                $cantidad=DB::select("select count(*) as 'cantidad' from alojamientos a where a.Pension_id=".$alojamiento->Pension_id." and a.tipo_habitacion_id=".$alojamiento->tipo_habitacion_id." and a.Temporada_id=".$alojamiento->Temporada_id);
                $precio="99.99";
                if($cantidad[0]->cantidad==0){


                  DB::statement(' Insert into alojamientos (Pension_id,tipo_habitacion_id,Temporada_id,precio) values ('.$alojamiento->Pension_id.','.$alojamiento->tipo_habitacion_id.','.$alojamiento->Temporada_id.','.$precio.')');
                }else{
                  $cantidad=DB::select("select a.id from alojamientos a where a.Pension_id=".$alojamiento->Pension_id." and a.tipo_habitacion_id=".$alojamiento->tipo_habitacion_id." and a.Temporada_id=".$alojamiento->Temporada_id);
                  Alojamiento::withTrashed()->find($cantidad[0]->id)->restore();
                  $encontrado=Alojamiento::findOrFail($cantidad[0]->id);
                  $encontrado->precio=$precio;
                  $encontrado->save();
                }
            }
         }
         return response()->json(['data'=>'tabla precios actualizada'],200);
    }
}
