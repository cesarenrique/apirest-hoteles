<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Alojamiento;

class Habitacion extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];

    protected $fillable = [
        'id',
        'numero',
        'Hotel_id',
        'tipo_habitacion_id',

    ];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

}
