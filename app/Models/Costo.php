<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costo extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_afiliacion',
        'valor_muerto',
        'valor_desembolso',
        'valor_mensual' 
    ];

}
