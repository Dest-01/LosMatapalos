<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntarioActividades extends Model
{
    use HasFactory;
    
    protected $fillable = ['idActividad','idVoluntario_Persona','idVoluntario_Estudiante'];
}
