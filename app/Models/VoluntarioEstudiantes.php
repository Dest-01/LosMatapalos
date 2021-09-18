<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntarioEstudiantes extends Model
{
    protected $fillable = ['id','identificacion', 'voluntariado_id', 'Universidad', 'carrera'];
}
