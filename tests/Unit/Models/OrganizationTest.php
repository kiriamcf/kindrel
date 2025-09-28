<?php 

declare(strict_types=1);

use App\Models\Organization;

test('organization model has fillable attributes', function () {
    $organization = new Organization();

    expect($organization->getFillable())
        ->toBe(['name', 'slug', 'address', 'phone', 'email']);
});

test('organization model has slug as route key name', function () {
    $organization = new Organization();

    expect($organization->getRouteKeyName())
        ->toBe('slug');
});