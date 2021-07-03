<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pension;
use App\TipoHabitacion;

class Hotel extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'NIF', 'nombre', 'Localidad_id',
      ];

    public function pensions(){
        return $this->hasMany(Pension::class);
    }

    public function tipo_habitacions(){
        return $this->hasMany(TipoHabitacion::class);
    }
}
