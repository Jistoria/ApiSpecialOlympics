<?php

namespace Database\Factories;

use App\Models\Deportista;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deportista>
 */
class DeportistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Deportista::class;

    public function definition(): array
    {
        $provincia = Provincia::inRandomOrder()->select('provincia_id')->first();

        return [
            'cedula' => $this->faker->unique()->text(10), // Genera un número de cédula de 7 dígitos
            'numero_deportista' => $this->faker->unique()->numberBetween(1000, 9999), // Genera un número de deportista de 4 dígitos
            'provincia_id' => $provincia,
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'edad' => $this->faker->numberBetween(10, 19),
            'genero' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}
