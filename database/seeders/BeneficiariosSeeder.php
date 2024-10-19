<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficiario;
use App\Models\Aportante;

class BeneficiariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aportante::firstOrCreate([
            'cedula' => '00000000',
        ], [
            'nombres' => 'Sin',
            'apellidos' => 'Aportante',
            'cedula' => '1', // Cedula de ejemplo
            'direccion' => 'N/A',
            'fecha_nacimiento' => now(),
            'telefono' => 'N/A',
        ]);

        Aportante::factory()->count(20)->create();

        // Genera 30 beneficiarios utilizando el factory
        Beneficiario::factory()->count(20)->create();
    }
}
