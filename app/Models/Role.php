<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre'
    ];

    /**
     * Relación con el modelo User
     * Un rol puede tener muchos usuarios
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
