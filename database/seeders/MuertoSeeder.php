<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muerto;

class MuertoSeeder extends Seeder
{
    public function run()
    {
        // Generar 30 muertos de prueba
        Muerto::factory()->count(30)->create();
    }
}
