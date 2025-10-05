<?php

declare(strict_types=1);

use App\Models\User;

test('user model has fillable attributes', function () {
    $user = new User();

    expect($user->getFillable())
        ->toBe(['name', 'email', 'password']);
});

test('user model hides sensitive attributes', function () {
    $user = new User();

    expect($user->getHidden())
        ->toBe(['password', 'remember_token']);
});

test('user model casts attributes correctly', function () {
    $user = new User();

    expect($user->getCasts())->toMatchArray([
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]);
});
