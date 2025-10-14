<?php

declare(strict_types=1);

use App\Models\Species;

test('species model has fillable attributes', function () {
    $species = new Species();

    expect($species->getFillable())
        ->toBe(['name', 'scientific_name', 'icon']);
});
