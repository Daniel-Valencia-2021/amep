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
        Aportante::factory()->count(20)->create();

        Beneficiario::factory()->count(20)->create();
    }
}
