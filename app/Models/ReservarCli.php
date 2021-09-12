<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservarCli extends Model
{
    protected $fillable = [
        'identificacion', 'cantidad', 'fecha', 'horaInicio', 'horaFin'
    ];
}
