<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participantes extends Model
{
    protected $fillable = ['id','nombre', 'apellido1', 'apellido2', 'nacionalidad'];
}
