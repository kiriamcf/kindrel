<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser;

use App\Actions\OrganizationUser\Dto\ListUsers as ListUsersDto;
use App\Models\Organization;
use App\Models\User;

class ListUsers
{
    public function execute(Organization $organization): ListUsersDto
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

        return new ListUsersDto(
            $organization,
            $users,
        );
    }
}