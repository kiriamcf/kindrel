<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser;

use App\Enums\OrgRole;
use App\Models\Organization;
use App\Models\User;

class AddOrganizationUserAction
{
    public function execute(Organization $organization, User $user): void
    {
        if ($organization->users()->where('user_id', $user->id)->exists()) {
            throw new \Exception('User is already a member of this organization.');
        }

        $organization->users()->attach($user->id, [
            'role' => OrgRole::MEMBER->value,
        ]);
    }
}