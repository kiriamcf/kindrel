<?php 

declare(strict_types=1);

use App\Models\Organization;
use App\Models\User;

test('users can be attached to many organizations', function () {
    $organizations = Organization::factory()->count(3)->create();
    $user = User::factory()->create();

    $user->organizations()->attach($organizations);

    expect($user->organizations)->toHaveCount(3);
});