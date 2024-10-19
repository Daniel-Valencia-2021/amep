<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'aportante_id',
        'fallecidos',
        'total',
        'fecha_pago',
        'pagado',
    ];

    // Cast fallecidos como array
    protected $casts = [
        'fallecidos' => 'array',
    ];

    // Relación con Aportante
    public function aportante()
    {
        return $this->belongsTo(Aportante::class);
    }

    // Relación con Muertos
    public function muertos()
    {
        return $this->hasMany(Muerto::class, 'id', 'fallecidos'); // Si decides usar IDs directamente
    }

}
