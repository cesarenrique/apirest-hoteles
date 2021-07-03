<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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

}
