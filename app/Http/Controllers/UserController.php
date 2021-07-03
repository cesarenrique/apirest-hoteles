<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios=User::all();

        return $this->showAll($usuarios);
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
        $rules=[
          'name'=>'required',
          'email'=> 'required|email|unique:users',
          'password' => 'required|min:6|confirmed'
        ];
        $this->validate($request,$rules);
        $campos=$request->all();
        $campos['password']= bcrypt($request->password);
        $campos['verified'] = User::USUARIO_NO_VERIFICADO;
        $campos['verification_token']= User::generateVerificationToken();
        $campos['tipo_usuario']= User::USUARIO_CLIENTE;

        $usuario= User::create($campos);
        return $this->showOne($usuario,201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario=User::findOrFail($id);

        return $this->showOne($usuario);
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
        $user= User::findOrFail($id);
        $rules=[
          'email'=> 'email|unique:users,email,'.$user->id,
          'password' => 'min:6|confirmed',
          'tipo_usuario' => 'in:'.User::USUARIO_ADMINISTRADOR.','.User::USUARIO_EDITOR.','.User::USUARIO_CLIENTE,
        ];
        $this->validate($request,$rules);
        if($request->has('name')){
            $user->name=$request->name;
        }
        if($request->has('email') && $user->email!=$request->email){
            $user->verified=User::USUARIO_NO_VERIFICADO;
            $user->verification_token=User::generateVerificationToken();
            $user->email=$request->email;

        }
        if($request->has('password')){
            $user->password=bcrypt($request->name);
        }
        if($request->has('tipo_usuario')){
            if(!$user->esVerificado()){
              return $this->errorResponse('Unicamente los usuarios verificados
              pueden cambiar su valor administrador',409);
            }
            $user->tipo_usuario=$request->tipo_usuario;
        }
        if(!$user->isDirty()){
           return $this->errorResponse('Se debe especificar al menos un valo
           r diferente para actualizar',409);
        }

        $user->save();

        return $this->showOne($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }
}
