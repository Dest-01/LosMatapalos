<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $fillable = ['id','nombre', 'apellido1', 'apellido2', 'telefono', 'correo'];
}
