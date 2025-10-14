<?php

declare(strict_types=1);

use App\Models\Animal;
use App\Models\Breed;
use App\Models\Species;

test('species can be associated with breeds', function () {
    $species = Species::factory()->create();
    Breed::factory()->for($species)->count(2)->create();

    expect($species->breeds)->toHaveCount(2);
    expect($species->breeds->first())->toBeInstanceOf(Breed::class);
});

test('species can be associated with animals', function () {
    $species = Species::factory()->create();
    Animal::factory()->for($species)->count(2)->create();

    expect($species->animals)->toHaveCount(2);
    expect($species->animals->first())->toBeInstanceOf(Animal::class);
});
