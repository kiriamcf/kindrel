<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;

class AnimalPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Animal $animal): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Animal $animal): bool
    {
        return false;
    }

    public function delete(User $user, Animal $animal): bool
    {
        return false;
    }

    public function restore(User $user, Animal $animal): bool
    {
        return false;
    }

    public function forceDelete(User $user, Animal $animal): bool
    {
        return false;
    }
}
