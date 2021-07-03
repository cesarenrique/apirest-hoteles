<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\TipoHabitacion;

class TipoHabitacionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipohab=TipoHabitacion::all();

        return $this->showAll($tipohab);
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
        ];
        $this->validate($request,$rules);
        $campos=$request->all();
        $tipohab=TipoHabitacion::create($campos);
        return $this->showOne($tipohab,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipohab=TipoHabitacion::findOrFail($id);
        return $this->showOne($tipohab);
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
        $tipohab=TipoHabitacion::findOrFail($id);
        $rules=[
          'tipo'=> 'min:2',
          'Hotel_id'=> 'exists:hotels,id',
        ];
        $this->validate($request,$rules);

        if($request->has('tipo')){
            $tipohab->tipo=$request->tipo;
        }

        if($request->has('Hotel_id')){
            $tipohab->Hotel_id=$request->Hotel_id;
        }

        if(!$tipohab->isDirty()){
           return $this->errorResponse('Se debe especificar al menos un valo
           r diferente para actualizar',409);
        }

        $tipohab->save();
        return $this->showOne($tipohab);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipohab=TipoHabitacion::findOrFail($id);
        $tipohab->delete();
        return $this->showOne($tipohab);

    }
}
