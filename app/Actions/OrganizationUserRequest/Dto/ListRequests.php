<?php

declare(strict_types=1);

namespace App\Actions\OrganizationUserRequest\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

final class ListRequests implements Arrayable
{
    public function __construct(
        public readonly Collection $requests,
    ) {
    }

    public function toArray(): array
    {
        return [
            'requests' => $this->requests,
        ];
    }
}
