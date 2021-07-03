<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pension extends Model
{
    use SoftDeletes;
    //
    const SOLO_ALOJAMIENTO="solo alojamiento";
    const PENSION_DESAYUNO="solo desayuno";
    const PENSION_COMPLETA="desayuno y comida";
    const PENSION_COMPLETA_CENA="desayuno, comida y cena";
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
    
    public function alojamientos(){
        return $this->hasMany(Alojamiento::class);
    }
}
