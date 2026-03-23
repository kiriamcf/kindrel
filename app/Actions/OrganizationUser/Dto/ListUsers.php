<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUser\Dto;

use App\Models\Organization;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

final class ListUsers implements Arrayable
{
    public function __construct(
        public readonly Organization $organization,
        public readonly Collection $users,
    ) {
    }

    public function toArray(): array
    {
        return [
            'organization' => $this->organization,
            'users' => $this->users,
        ];
    }
}
