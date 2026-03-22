<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest;

use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;

class ListOrganizationsForRequestAction
{
    public function execute(User $user): array
    {
        $requests = OrganizationUserRequest::where('user_id', $user->id)
            ->get(['organization_id', 'status']);

        $granted = $requests->where('status', OrgRequestStatus::APPROVED->value)
            ->pluck('organization_id')
            ->toArray();

        $requested = $requests->where('status', OrgRequestStatus::PENDING->value)
            ->pluck('organization_id')
            ->toArray();

        $organizations = Organization::whereIntegerNotInRaw('id', $granted)
            ->paginate(12);

        return [
            'organizations' => $organizations,
            'requested' => $requested,
        ];
    }
}