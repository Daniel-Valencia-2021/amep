<?php

namespace Database\Factories;

use App\Models\Beneficiario;
use App\Models\Aportante; // Si Beneficiario está relacionado con Aportante
use Illuminate\Database\Eloquent\Factories\Factory;


class BeneficiarioFactory extends Factory
{
    /**
     * El nombre del modelo asociado.
     *
     * @var string
     */
    protected $model = Beneficiario::class;

    /**
     * Define el estado por defecto del factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'tipo_identificacion' => $this->faker->randomElement(['TI', 'RC']),
            'identificacion' => $this->faker->unique()->numerify('##########'), // Genera una identificación única
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2010-01-01'), // Fecha de nacimiento antes de 2010
            'direccion' => $this->faker->address,
            'parentesco' => $this->faker->randomElement(['Hijo', 'Sobrino', 'Nieto', 'Primo']),
            'aportante_id' => Aportante::inRandomOrder()->first()->id, // Relaciona con un Aportante aleatorio
        ];
    }
}
