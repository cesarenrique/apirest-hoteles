<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Provincia;

class Pais extends Model
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

  public function provincias(){
    return $this->hasMany(Provincia::class);
  }
}
