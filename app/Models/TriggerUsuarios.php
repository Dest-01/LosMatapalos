<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TriggerUsuarios extends Model
{
    use HasFactory;

    protected $fillable = ['id','usuarioActivo','usuarioAgregado', 'usuarioModificadoAntes', 'usuarioModificadoNuevo', 'usuarioEliminado', 'accion','fecha','hora'];
}
