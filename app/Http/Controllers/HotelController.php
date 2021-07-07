<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Hotel;

class HotelController extends ApiController
{

  public function __construct(){
    parent::
    $this->middleware('client.credentials');

  }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels=Hotel::all();

        return $this->showAll($hotels);
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
          'NIF'=> 'required|min:8',
          'nombre'=> 'required|min:2',
          'Localidad_id' => 'required|exists:localidads,id',
        ];
        $this->validate($request,$rules);
        $campos=$request->all();
        $hotel=Hotel::create($campos);
        return $this->showOne($hotel,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel=Hotel::findOrFail($id);
        return $this->showOne($hotel);
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
      $hotel=Hotel::findOrFail($id);
      $rules=[
        'NIF'=> 'min:8',
        'nombre'=> 'min:2',
        'Localidad_id' => 'exists:localidads,id',
      ];
      $this->validate($request,$rules);

      if($request->has('NIF')){
          $hotel->NIF=$request->NIF;
      }

      if($request->has('nombre')){
          $hotel->nombre=$request->nombre;
      }

      if($request->has('Localidad_id')){
          $hotel->Localidad_id=$request->Localidad_id;
      }

      if(!$hotel->isDirty()){
         return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
      }

      $hotel->save();
      return $this->showOne($hotel);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel=Hotel::findOrFail($id);
        $hotel->delete();
        return $this->showOne($hotel);
    }
}
