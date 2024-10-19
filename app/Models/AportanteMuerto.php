<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AportanteMuerto extends Model
{
    use HasFactory;

    protected $table = 'aportante_muerto'; // Nombre de la tabla pivote

    protected $fillable = [
        'aportante_id',
        'muerto_id',
    ];

    public function aportante()
    {
        return $this->belongsTo(Aportante::class);
    }

    public function muerto()
    {
        return $this->belongsTo(Muerto::class);
    }
}
