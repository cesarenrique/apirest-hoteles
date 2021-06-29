<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;


    const USUARIO_VERIFICADO='1';
    const USUARIO_NO_VERIFICADO='0';

    const USUARIO_NO_REGISTRADO='0';
    const USUARIO_ADMINISTRADOR='1';
    const USUARIO_EDITOR='2';
    const USUARIO_CLIENTE='3';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'verification_token', 'tipo_usuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function esVerificado(){
      return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function esAdministrador(){
      return $this->tipo_usuario == User::USUARIO_ADMINISTRADOR;
    }

    public function esEditor(){
      return $this->tipo_usuario == User::USUARIO_EDITOR;
    }


    public function esCliente(){
      return $this->tipo_usuario == User::USUARIO_CLIENTE;
    }

    public static function generateVerificationToken(){
      return Str::random(40);
    }
}
