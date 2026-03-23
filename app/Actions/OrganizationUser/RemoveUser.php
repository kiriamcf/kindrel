<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser;

use App\Models\Organization;
use App\Models\User;

class RemoveUser
{
    public function execute(Organization $organization, User $user): void
    {
        $organization->users()->detach($user->id);
    }
}