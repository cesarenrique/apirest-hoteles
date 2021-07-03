<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hotel extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'NIF', 'nombre', 'Localidad_id', 
      ];
}
