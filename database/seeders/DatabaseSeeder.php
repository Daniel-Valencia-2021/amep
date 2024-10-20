<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CausaDeMuerte;
use App\Models\Aportante;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear la causa de muerte predeterminada
        CausaDeMuerte::create(['nombre' => 'Muerte Natural']);

        // Crear el primer aportante "Sin Aportante"
        Aportante::create([
            'nombres' => 'Sin',
            'apellidos' => 'Aportante',
            'cedula' => '1',
            'telefono' => '0000000000',
            'direccion' => 'N/A',
            'fecha_nacimiento' => now(),
            'afiliacion_pagada' => false,
        ]);

        // Crear el usuario Admin
        User::create([
            'username' => 'admin',
            'password' => 'admin', // Cifrado de la contraseña
            'role' => 'admin',
        ]);

        // Crear el usuario Secretaria
        User::create([
            'username' => 'secretaria',
            'password' => 'secretaria', // Cifrado de la contraseña
            'role' => 'secretaria',
        ]);
    }
}
