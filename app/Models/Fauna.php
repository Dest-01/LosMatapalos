<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fauna extends Model
{
    use HasFactory;

    protected $fillable = ['id','nombreComun','nombreCientifico','descripcion','tipo','imagen','familiaCientifca','fechaRegistro'];
}
