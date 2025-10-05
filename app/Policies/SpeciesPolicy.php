<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Species;
use App\Models\User;

class SpeciesPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Species $species): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Species $species): bool
    {
        return false;
    }

    public function delete(User $user, Species $species): bool
    {
        return false;
    }

    public function restore(User $user, Species $species): bool
    {
        return false;
    }

    public function forceDelete(User $user, Species $species): bool
    {
        return false;
    }
}
