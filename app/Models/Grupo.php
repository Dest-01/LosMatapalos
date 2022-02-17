<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre', 'correo', 'cantidad', 'edades', 'lugar', 'tematica', 'detalles'];
}
