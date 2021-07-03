<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{

    use SoftDeletes;

    const LIBRE='libre';
    const RESERVADO='reservado';

    const PAGADO_TOTALMENTE="totalmente";
    const PAGADO_PARCIALMENTE="parcialmente";

    protected $dates=['deleted_at'];
    //
}
