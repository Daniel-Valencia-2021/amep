<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aportante>
 */
class AportanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'cedula' => $this->faker->unique()->randomNumber(8),
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'fecha_nacimiento' => $this->faker->date(),
        ];
    }
}
