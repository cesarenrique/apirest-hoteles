<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Habitacion;
use App\Transformers\TipoHabitacionTransformer;

class TipoHabitacion extends Model
{
    use SoftDeletes;

    //basicos
    const HABITACION_NORMAL="normal";
    const HABITACION_SIMPLE="simple";
    const HABITACION_DOBLE="doble";
    const HABITACION_MATRIMONIAL="matrimonial";
    public $transformer= TipoHabitacionTransformer::class;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $dates=['deleted_at'];
    protected $fillable = [
      'tipo',
      'Hotel_id',
    ];

    public function habitacions(){
      return $this->hasMany(Habitacion::class);
    }

    public function alojamientos(){
      return $this->hasMany(Alojamiento::class);
    }
}
