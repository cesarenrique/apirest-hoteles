<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Tarjeta;

class TarjetaController extends ApiController
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
        $tarjetas=Tarjeta::all();
        return $this->showAll($tarjetas);
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
        'numero'=> 'required|min:15',
        'Cliente_id'=> 'required|exists:clientes,id',
      ];
      $this->validate($request,$rules);
      $campos=$request->all();
      $tarjeta=Tarjeta::create($campos);
      return $this->showOne($tarjeta,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tarjeta=Cliente::findOrFail($id);
      return $this->showOne($tarjeta);
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
      $tarjeta=Cliente::findOrFail($id);
      $rules=[
        'numero'=> 'min:15',
      ];
      $this->validate($request,$rules);

      if($request->has('numero')){
          $cliente->numero=$request->numero;
      }

      if(!$tarjeta->isDirty()){
         return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
      }

      $tarjeta->save();

      return $this->showOne($tarjeta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tarjeta=Cliente::findOrFail($id);
      $tarjeta->delete();
      return $this->showOne($tarjeta);
    }
}
