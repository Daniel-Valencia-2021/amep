<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion',
        'direccion',
        'parentesco',
        'fecha_nacimiento',
        'aportante_id',
        'tipo_identificacion',
        'afiliacion_pagada', // Agregar el campo
    ];

    public function aportante()
    {
        return $this->belongsTo(Aportante::class);
    }
}
