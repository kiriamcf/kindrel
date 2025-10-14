<?php

declare(strict_types=1);

use App\Models\Breed;

test('breed model has fillable attributes', function () {
    $breed = new Breed();

    expect($breed->getFillable())
        ->toBe(['name', 'species_id']);
});

test('breed model casts attributes correctly', function () {
    $breed = new Breed();

    expect($breed->getCasts())->toMatchArray([
        'species_id' => 'integer',
    ]);
});
