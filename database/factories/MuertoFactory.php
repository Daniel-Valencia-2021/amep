<?php

namespace Database\Factories;

use App\Models\Muerto;
use App\Models\CausaDeMuerte;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MuertoFactory extends Factory
{
    protected $model = Muerto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'identificacion' => $this->faker->unique()->numerify('#########'),
            'tipo_identificacion' => $this->faker->randomElement(['Cédula', 'TI', 'RC']),
            'fecha_fallecimiento' => $this->faker->date(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-20 years'), // Generar una fecha de nacimiento aleatoria hace más de 20 años
            'causa_muerte_id' => CausaDeMuerte::inRandomOrder()->first()->id, // Obtener una causa de muerte aleatoria
        ];
    }
}
