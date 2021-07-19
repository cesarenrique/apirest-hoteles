<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pension;
use App\TipoHabitacion;
use App\Transformers\HotelTransformer;

class Hotel extends Model
{
    use SoftDeletes;

    public $transformer= HotelTransformer::class;
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

    public function habitacions(){
        return $this->hasMany(Habitacion::class);
    }

    public function fechas(){
        return $this->hasMany(Fecha::class);
    }

    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}
