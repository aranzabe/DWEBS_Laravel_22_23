<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('1234'), // password
            'remember_token' => Str::random(10),
            'cargo' => $this->faker->randomElement(['profesor', 'jefe de estudios', 'tutor','guardián de la luz de Ellendhil']),
            'departamento' => $this->faker->randomElement(['Informática', 'Administración', 'Educación Física','Frío y Calor','Física o Química']),
            'edad' => rand(18,100),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
