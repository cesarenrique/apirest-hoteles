<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoHabitacion extends Model
{
    use SoftDeletes;

    //basicos
    const HABITACION_NORMAL="normal";
    const HABITACION_SIMPLE="simple";
    const HABITACION_DOBLE="doble";
    const HABITACION_MATRIMONIAL="matrimonial";
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
}
