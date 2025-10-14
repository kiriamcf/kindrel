<?php

declare(strict_types=1);

use App\Models\Breed;
use App\Models\Species;

test('breeds have an associated species', function () {
    $breed = Breed::factory()->create();

    expect($breed->species_id)->toBeTruthy();

    expect($breed->species)->toBeInstanceOf(Species::class);
});
