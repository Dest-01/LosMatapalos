<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividades extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','fecha','hora','descripcion','cantParticipantes','imagen','tipo'];
}