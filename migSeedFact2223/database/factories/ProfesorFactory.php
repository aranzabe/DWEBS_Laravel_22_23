<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'cargo' => $this->faker->randomElement(['profesor', 'jefe de estudios', 'tutor','guardián de la luz de Ellendhil']),
            'departamento' => $this->faker->randomElement(['Informática', 'Administración', 'Educación Física','Frío y Calor','Física o Química']),
            'edad' => rand(18,100),
            'observaciones' => $this->faker->text(100)
        ];
    }
}
