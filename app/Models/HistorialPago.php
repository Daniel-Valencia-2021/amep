<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_aportante',
        'cedula_aportante',
        'total',
        'fecha_pago',
        'muertos_pagados', // IDs de los muertos pagados (almacenados como JSON)
    ];

    // Relación con los muertos pagados
    public function muertos()
    {
        return $this->belongsToMany(Muerto::class, 'muerto_historial_pago', 'historial_pago_id', 'muerto_id');
    }
}
