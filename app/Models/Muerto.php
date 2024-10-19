<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muerto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'tipo_identificacion',
        'fecha_nacimiento',
        'fecha_fallecimiento',
        'causa_muerte_id',
    ];

    public function causaDeMuerte()
    {
        return $this->belongsTo(CausaDeMuerte::class, 'causa_muerte_id');
    }

    public function aportantes()
    {
        return $this->belongsToMany(Aportante::class, 'aportante_muerto');
    }
}
