<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfiliacionPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'aportante_id',
        'costo_id',//borrar en caso de no ser necesario
        //'valor_afiliacion',
        'valor_mensual_pagado',
        'meses_pagados',
        'total',
        'fecha_pago',
        'concepto',
    ];

    // Relación con el modelo Aportante
    public function aportante()
    {
        return $this->belongsTo(Aportante::class);
    }


    public function costo()
    {
        return $this->belongsTo(Costo::class);
    }
}
