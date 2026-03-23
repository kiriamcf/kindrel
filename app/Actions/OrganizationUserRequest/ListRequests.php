<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest;

use App\Actions\OrganizationUserRequest\Dto\ListRequests as ListRequestsDto;
use App\Models\Organization;
use App\Models\User;

class ListRequests
{
    public function execute(Organization $organization): ListRequestsDto
    {
        $requests = $organization->requests()
            ->withPivot('status')
            ->get()
            ->map(function (User $user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->pivot->status,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                ];
            });

        return new ListRequestsDto($requests);
    }
}