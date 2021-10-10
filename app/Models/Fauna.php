<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fauna extends Model
{
    protected $fillable = ['id','nombreComun','nombreCientifico','descripcion','tipo','imagen','familiaCientifca','fechaRegistro'];
}
