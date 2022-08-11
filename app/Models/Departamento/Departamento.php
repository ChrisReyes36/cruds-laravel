<?php

namespace App\Models\Departamento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  use HasFactory;

  protected $table = 'aca_departamentos';

  // Relación de uno a muchos
  public function users()
  {
    return $this->hasMany('App\Models\User');
  }
}
