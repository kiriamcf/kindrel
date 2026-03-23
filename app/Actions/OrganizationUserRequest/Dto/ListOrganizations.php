<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest\Dto;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;

final class ListOrganizations implements Arrayable
{
    public function __construct(
        public readonly LengthAwarePaginator $organizations,
        public readonly array $requested,
    ) {
    }

    public function toArray(): array
    {
        return [
            'organizations' => $this->organizations,
            'requested' => $this->requested,
        ];
    }
}
