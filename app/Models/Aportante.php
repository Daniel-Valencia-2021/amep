<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aportante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'afiliacion_pagada', // Agregar el campo
    ];

    public function beneficiarios()
    {
        return $this->hasMany(Beneficiario::class);
    }

    public function muertos()
    {
        return $this->belongsToMany(Muerto::class, 'aportante_muerto');
    }

    public function afiliacionPagos()
    {
        return $this->hasMany(AfiliacionPago::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'aportante_id');
    }
}
