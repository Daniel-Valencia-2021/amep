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
        'costo_id',//borrar en caso de no ser necesario
        //'valor_desembolso',
        'fecha_desembolso',
    ];

    // Relación con el modelo Muerto
    public function muerto()
    {
        return $this->belongsTo(Muerto::class);
    }

    public function costo()
    {
        return $this->belongsTo(Costo::class);
    }
}
