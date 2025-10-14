<?php

declare(strict_types=1);

use App\Models\Animal;
use App\Models\Breed;
use App\Models\Species;

test('animals have an associated species', function () {
    $animal = Animal::factory()->create();

    expect($animal->species)->toBeInstanceOf(Species::class);
});

test('animals have an associated breed', function () {
    $animal = Animal::factory()->create();

    expect($animal->breed)->toBeInstanceOf(Breed::class);
});
