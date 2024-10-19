<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CausaDeMuerte extends Model
{
    use HasFactory;

    // Nombre de la tabla explícito
    protected $table = 'causas_de_muerte';

    protected $fillable = ['nombre'];
}
