<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $fillable = ['cedula', 'nombre', 'apellido1', 'apellido2', 'telefono', 'correo'];
}
