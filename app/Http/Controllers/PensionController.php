<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Pension;

class PensionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pensiones=Pension::all();

        return $this->showAll($pensiones);
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
        $pension=Pension::create($campos);
        return $this->showOne($pension,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pension=Pension::findOrFail($id);
        return $this->showOne($pension);
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
        $pension=Pension::findOrFail($id);
        $rules=[
          'tipo'=> 'min:2',
          'Hotel_id'=> 'exists:hotels,id',
        ];
        $this->validate($request,$rules);

        if($request->has('tipo')){
            $pension->tipo=$request->tipo;
        }

        if($request->has('Hotel_id')){
            $pension->Hotel_id=$request->Hotel_id;
        }

        if(!$pension->isDirty()){
           return $this->errorResponse('Se debe especificar al menos un valo
           r diferente para actualizar',409);
        }

        $pension->save();
        return $this->showOne($pension);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pension=Pension::findOrFail($id);
        $pension->delete();
        return $this->showOne($pension);
    }
}
