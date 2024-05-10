<?php

namespace Database\Factories;

use App\Models\Invitado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitado>
 */
class InvitadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Invitado::class;
    public function definition(): array
    {
        return [
            'cedula' => $this->faker->unique()->text(10),
            'provincia_id' => $this->faker->numberBetween(1, 24),
            'tipo_invitado_id' => $this->faker->numberBetween(1, 5),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'edad' => $this->faker->numberBetween(18, 60),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'activo' => $this->faker->boolean(),
        ];
    }
}
