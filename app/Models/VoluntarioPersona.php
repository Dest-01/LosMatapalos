<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntarioPersona extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'identificacion', 'identificacionPersona', 'voluntariado_id', 'lugar'];
}
