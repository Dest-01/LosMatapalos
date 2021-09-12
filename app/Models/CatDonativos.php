<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatDonativos extends Model
{
    protected $fillable = ['nombre', 'estado', 'photo'];
}
