<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest;

use App\Actions\OrganizationUserRequest\Dto\ListOrganizations as ListOrganizationsDto;
use App\Enums\OrgRequestStatus;
use App\Models\Organization;
use App\Models\OrganizationUserRequest;
use App\Models\User;

class ListOrganizations
{
    public function execute(User $user): ListOrganizationsDto
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

        return new ListOrganizationsDto(
            $organizations,
            $requested,
        );
    }
}