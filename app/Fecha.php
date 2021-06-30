<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
  const INICIAL='2021-01-01';
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'abierto',
  ];

}
