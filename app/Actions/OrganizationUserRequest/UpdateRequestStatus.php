<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest;

use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;

class UpdateRequestStatus
{
    public function execute(Organization $organization, User $user, string $status): void
    {
        $organizationRequest = OrganizationUserRequest::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', OrgRequestStatus::PENDING->value)
            ->first();

        if (! $organizationRequest) {
            throw new \Exception('No pending request found for this user and organization.');
        }

        $organizationRequest->update(['status' => $status]);

        if ($status === OrgRequestStatus::APPROVED->value) {
            if (! $organization->users()->where('user_id', $user->id)->exists()) {
                $organization->users()->attach($user->id);
            }
        }
    }
}