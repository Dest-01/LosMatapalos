<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donativos extends Model
{
    protected $fillable = ['tipo', 'detalle', 'photo', 'fecha', 'estado'];
}
