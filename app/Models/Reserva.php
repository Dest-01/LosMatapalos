<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['idPersona', 'identificacionPersona', 'idOrganizacion', 'identificacionOrganizacion', 'idGrupo', 'nombreGrupo', 'cantidad', 'fecha', 'horaInicio', 'horaFin'];

    public function personas()
    {
        return $this->belongsTo(Personas::class);
    }

    public function organizaciones()
    {
        return $this->belongsTo(Organizaciones::class);
    }
}
