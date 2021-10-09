<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservarCli extends Model
{
    use HasFactory;

    protected $fillable = ['idPersona', 'idOrganizacion', 'cantidad', 'fecha', 'horaInicio', 'horaFin'];

    public function personas()
    {
        return $this->belongsTo(Personas::class);
    }

    public function organizaciones()
    {
        return $this->belongsTo(Organizaciones::class);
    }
}
