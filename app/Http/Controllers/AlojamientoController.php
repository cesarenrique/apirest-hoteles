<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Alojamiento;

class AlojamientoController extends ApiController
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
        $alojamientos=Alojamiento::all();
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
        $alojamiento=Alojamiento::findOrFail($id);
        return $this->showOne($alojamiento);
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
      $alojamiento=Hotel::findOrFail($id);
      $rules=[
        'precio'=> 'required',
      ];

      $this->validate($request,$rules);

      if($request->has('precio')){
          if(!(preg_match_all('/^[0-9]+([,][0-9]+)?$/',$request->precio))){
             return $this->errorResponse("el precio tiene que ser formato float",401);
          }
          $alojamiento->precio=$request->precio;
      }


      if(!$alojamiento->isDirty()){
         return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
      }

      $alojamiento->save();
      return $this->showOne($alojamiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $alojamiento=Alojamiento::findOrFail($id);
      $alojamiento->delete();
      return $this->showOne($alojamiento);
    }
}
