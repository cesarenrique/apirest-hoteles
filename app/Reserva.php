<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{

    use SoftDeletes;

    const LIBRE='libre';
    const RESERVADO='reservado';

    const PAGADO_TOTALMENTE="totalmente pagado";
    const PAGADO_PARCIALMENTE="parcialmente pagado";

    protected $dates=['deleted_at'];
    protected $fillable = [
        'id',
        'pagado',
        'estado',
        'reservado',
        'Cliente_id',
        'Fecha_id',
        'Habitacion_id',
        'Alojamiento_id',
    ];

    public function fecha(){
        return $this->belongsTo(Fecha::class);
    }
}
