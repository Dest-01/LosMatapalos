<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donativos extends Model
{
    use HasFactory;

    protected $fillable = ['tipo','idPersona', 'idOrganizacion', 'detalle', 'photo', 'fecha', 'estado'];

    public function personas()
    {
        return $this->belongsTo(Personas::class);
    }

    public function organizaciones()
    {
        return $this->belongsTo(Organizaciones::class);
    }


}


