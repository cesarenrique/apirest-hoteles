<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pais;
use App\Localidad;

class Provincia extends Model
{
  use Notifiable,SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $dates=['deleted_at'];
  protected $fillable = [
      'id','nombre', 'Pais_id',
  ];
  public function pais(){
    return $this->belongsTo(Pais::class);
  }

  public function localidads(){
    return $this->hasMany(Localidad::class);
  }
}
