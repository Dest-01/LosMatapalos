<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepositorioDocumentos extends Model
{
   protected $fillable = ['nombre','fecha','descripcion','tipo','documento'];
}
