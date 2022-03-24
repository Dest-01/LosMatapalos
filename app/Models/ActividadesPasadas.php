<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesPasadas extends Model
{
    use HasFactory;
    protected $fillable=['id','nombre','fecha','descripcion','imagen'];
}
