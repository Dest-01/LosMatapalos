<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizaciones extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'identificacion', 'nombre', 'telefono', 'correo'];
}
