<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donativos extends Model
{
    protected $fillable = ['nombre', 'tipo', 'descripcion', 'fecha'];
}
