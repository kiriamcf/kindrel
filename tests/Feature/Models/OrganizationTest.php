<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Models\User;

test('organization can have many users attached', function () {
    $organization = Organization::factory()->create();
    $users = User::factory()->count(3)->create();

    $organization->users()->attach($users);

    expect($organization->users)->toHaveCount(3);
});
