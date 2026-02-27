<?php declare(strict_types=1);

namespace App\Enums;

enum OrgRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MEMBER = 'member';
}