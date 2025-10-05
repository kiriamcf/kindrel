<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Breed;
use App\Models\User;

class BreedPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Breed $breed): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Breed $breed): bool
    {
        return false;
    }

    public function delete(User $user, Breed $breed): bool
    {
        return false;
    }

    public function restore(User $user, Breed $breed): bool
    {
        return false;
    }

    public function forceDelete(User $user, Breed $breed): bool
    {
        return false;
    }
}
