<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Species;
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
            'species_id' => Species::factory(),
            'breed_id' => Breed::factory(),
            'age' => fake()->numberBetween(1, 15),
            'arrival_date' => fake()->date(),
        ];
    }
}
