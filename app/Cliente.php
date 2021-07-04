<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Tarjeta;
use App\Reserva;

class Cliente extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'NIF','nombre', 'email', 'telefono',
    ];
    public function tarjetas(){
        return $this->hasMany(Tarjeta::class);
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}
