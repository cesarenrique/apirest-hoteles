<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alojamiento extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];
    protected $fillable = [
        'id',
        'precio',
        'Pension_id',
        'tipo_habitacion_id',
        'Temporada_id',

    ];
}
