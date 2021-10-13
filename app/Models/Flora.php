<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flora extends Model
{
    use HasFactory;
    protected $fillable = ['id','nom_comun','nom_cientifico', 'descripcion', 'tipo', 'photo', 'fam_cientifica', 'fecha_registro'];
}
