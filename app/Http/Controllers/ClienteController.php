<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Cliente;

class ClienteController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=Cliente::all();
        return $this->showAll($clientes);
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
        'email' => 'required|email',
        'telefono'=> 'required|min:8',
      ];
      $this->validate($request,$rules);
      $campos=$request->all();
      $hotel=Cliente::create($campos);
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
        $cliente=Cliente::findOrFail($id);
        return $this->showOne($cliente);
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
      $cliente=Cliente::findOrFail($id);
      $rules=[
        'NIF'=> 'min:8',
        'nombre'=> 'min:2',
        'email' => 'email',
        'telefono'=> 'min:8',
      ];
      $this->validate($request,$rules);
      if($request->has('NIF')){
          $cliente->NIF=$request->NIF;
      }
      if($request->has('nombre')){
          $cliente->nombre=$request->nombre;
      }
      if($request->has('email')){
          $cliente->email=$request->email;
      }
      if($request->has('telefono')){
          $cliente->telefono=$request->telefono;
      }
      if(!$cliente->isDirty()){
         return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar',409);
      }

      $cliente->save();

      return $this->showOne($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cliente=Cliente::findOrFail($id);
      $cliente->delete();
      return $this->showOne($cliente);
    }
}
