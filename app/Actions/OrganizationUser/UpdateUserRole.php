<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser;

use App\Models\Organization;
use App\Models\User;

class UpdateUserRole
{
    public function execute(Organization $organization, User $user, string $role): void
    {
        $organization->users()->updateExistingPivot($user->id, [
            'role' => $role,
        ]);
    }
}