<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesParticipantes extends Model
{
    protected $fillable = ['id', 'idActividad', 'idVoluntario'];
}
