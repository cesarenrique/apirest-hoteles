<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
  use Notifiable,SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $dates=['deleted_at'];
  protected $fillable = [
      'id',
      'nombre',
  ];
}
