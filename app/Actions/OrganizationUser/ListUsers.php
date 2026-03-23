<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser;

use App\Models\Organization;
use App\Models\User;

class ListUsers
{
    public function execute(Organization $organization): array
    {
        $users = $organization->users()
            ->withPivot('role')
            ->get()
            ->map(function (User $user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->pivot->role,
                    'created_at' => $user->pivot->created_at,
                    'updated_at' => $user->pivot->updated_at,
                ];
            });

        return [
            'users' => $users,
            'organization' => $organization,
        ];
    }
}