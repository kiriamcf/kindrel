<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            // 'species' => fake()->word(),
            // 'age' => fake()->numberBetween(1, 15),
            'weight' => fake()->numberBetween(5, 100),
            'height' => fake()->numberBetween(30, 100),
        ];
    }
}
