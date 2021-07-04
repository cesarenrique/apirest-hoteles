<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Temporada;

class TemporadaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
      $temporada=Temporada::findOrFail($id);
      $temporada->delete();
      return $this->showOne($temporada);
    }
}
