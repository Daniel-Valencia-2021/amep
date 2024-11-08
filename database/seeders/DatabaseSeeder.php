<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CausaDeMuerte;
use App\Models\Aportante;
use App\Models\User;
use App\Models\Beneficiario;
use App\Models\Muerto;
use App\Models\Role;

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

            // Crear roles por defecto
            $adminRole = Role::create(['nombre' => 'admin']);
            $secretariaRole = Role::create(['nombre' => 'secretaria']);
    
            // Crear el usuario Admin y asignarle el rol
            User::create([
                'username' => 'admin',
                'password' => 'admin', // Cifrado de la contraseña
                'role_id' => $adminRole->id,
            ]);
    
            // Crear el usuario Secretaria y asignarle el rol
            User::create([
                'username' => 'secretaria',
                'password' => 'secretaria', // Cifrado de la contraseña
                'role_id' => $secretariaRole->id,
            ]);

        Aportante::factory()->count(20)->create();

        Beneficiario::factory()->count(20)->create();

       // Muerto::factory()->count(30)->create();

    }
}
