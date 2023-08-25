<?php

declare(strict_types=1);

namespace App\Entity;

enum ClubMemberRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case USER = 'user';
}
