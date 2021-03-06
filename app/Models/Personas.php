<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'identificacion', 'nombre', 'apellido1', 'apellido2', 'telefono', 'correo'];
}
