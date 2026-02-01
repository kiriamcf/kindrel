<?php

declare(strict_types=1);

namespace App\Enums;

enum OrgRequestStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}