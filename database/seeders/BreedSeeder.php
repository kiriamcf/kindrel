<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    public function run(): void
    {
        // ID 1 corresponds to Dog in SpeciesSeeder
        Breed::insert([
            ['name' => 'Labrador Retriever', 'species_id' => 1],
            ['name' => 'Pastor Alemany', 'species_id' => 1],
            ['name' => 'Retriever daurat', 'species_id' => 1],
            ['name' => 'Bulldog', 'species_id' => 1],
        ]);

        // ID 2 corresponds to Cat in SpeciesSeeder
        Breed::insert([
            ['name' => 'Siamès', 'species_id' => 2],
            ['name' => 'Persa', 'species_id' => 2],
            ['name' => 'Maine Coon', 'species_id' => 2],
            ['name' => 'Bengala', 'species_id' => 2],
        ]);

        // ID 3 corresponds to Bird in SpeciesSeeder
        Breed::insert([
            ['name' => 'Lloro', 'species_id' => 3],
            ['name' => 'Canari', 'species_id' => 3],
            ['name' => 'Pinsà', 'species_id' => 3],
            ['name' => 'Gorrió', 'species_id' => 3],
        ]);
    }
}
