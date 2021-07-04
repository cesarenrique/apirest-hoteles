<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\User;
class LoginController extends ApiController
{
    public function login(Request $request){
       $rules=[
          'email'=> 'required|string',
          'password' =>'required|string',
       ];
       $this->validate($request,$rules);
       $login=$request->all();
       if(!Auth::attempt($login)){
         return $this->errorResponse("credenciales invalidas",401);
       }
       $user=User::where('email',$request->email)->first();
       $accesToken = $user->createToken('authToken')->token;
       return response()->json(['data'=>['user' => $user,'access_token'=>$accesToken]],200);
    }


    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        $campos=$request->all();
        $campos['password']= bcrypt($request->password);
        $campos['verified'] = User::USUARIO_NO_VERIFICADO;
        $campos['verification_token']= User::generateVerificationToken();
        $campos['tipo_usuario']= User::USUARIO_CLIENTE;
        User::create($campos);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
}
