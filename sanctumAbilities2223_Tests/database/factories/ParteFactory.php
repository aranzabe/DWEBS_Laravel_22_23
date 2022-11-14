<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ParteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alumno' => $this->faker->name,
            'gravedad' => $this->faker->randomElement(['Leve', 'Grave', 'Destierro']),
            'idProfesor' => $this->faker->randomElement(User::get('id')),
            'observaciones' => $this->faker->text(100)
        ];
    }
}
