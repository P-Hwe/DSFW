<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'isbn' => $this->faker->unique()->isbn13(),
            'ano_publicacao' => $this->faker->year(),
            'quantidade_total' => 1,
            'quantidade_disponivel' => 1,
        ];
    }
}
