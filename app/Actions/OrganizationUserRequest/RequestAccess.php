<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest;

use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;

class RequestAccess
{
    public function execute(Organization $organization, User $user): void
    {
        $exists = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', OrgRequestStatus::PENDING->value)
            ->exists();

        if ($exists) {
            throw new \Exception('You have already requested access to this organization.');
        }

        $organization->requests()->attach($user->id, [
            'status' => OrgRequestStatus::PENDING->value,
        ]);
    }
}