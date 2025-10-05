<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        Species::createMany([
            [
                'name' => 'Dog',
                'icon' => '🐶',
                'scientific_name' => 'Canis lupus familiaris',
            ],
            [
                'name' => 'Cat',
                'icon' => '🐱',
                'scientific_name' => 'Felis catus',
            ],
            [
                'name' => 'Bird',
                'icon' => '🐦',
                'scientific_name' => 'Aves',
            ],
        ]);
    }
}
