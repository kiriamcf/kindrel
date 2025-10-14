<?php

declare(strict_types=1);

use App\Models\Animal;

test('animal model has fillable attributes', function () {
    $animal = new Animal();

    expect($animal->getFillable())
        ->toBe(['name', 'species_id', 'breed_id', 'age', 'arrival_date']);
});

test('animal model casts attributes correctly', function () {
    $animal = new Animal();

    expect($animal->getCasts())->toMatchArray([
        'species_id' => 'integer',
        'breed_id' => 'integer',
        'age' => 'integer',
        'arrival_date' => 'datetime',
    ]);
});
