<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desembolso extends Model
{
    use HasFactory;

    protected $fillable = [
        'muerto_id',
        'nombre_reclamante',
        'apellidos_reclamante',
        'cedula_reclamante',
        'telefono_reclamante',
        'parentesco',
        'valor_desembolso',
        'fecha_desembolso',
    ];

    // Relación con el modelo Muerto
    public function muerto()
    {
        return $this->belongsTo(Muerto::class);
    }
}
