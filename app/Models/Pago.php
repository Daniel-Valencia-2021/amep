<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'aportante_id',
        'total',
        'fecha_pago',
        'muertos_pagados',
    ];

    // Relación con Aportante
    public function aportante()
    {
        return $this->belongsTo(Aportante::class);
    }

    // Relación con los muertos pagados
    public function muertos()
    {
        return $this->belongsToMany(Muerto::class, 'muerto_pago', 'pago_id', 'muerto_id');
    }
}
