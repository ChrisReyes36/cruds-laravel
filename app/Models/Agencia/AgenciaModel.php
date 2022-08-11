<?php

namespace App\Models\Agencia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenciaModel extends Model
{
  use HasFactory;

  protected $table = 'aca_agencias';

  // Relación de uno a muchos
  public function users()
  {
    return $this->hasMany('App\Models\User');
  }
}
