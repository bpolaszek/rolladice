<?php

declare(strict_types=1);

namespace App\Entity;

enum ClubMemberRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case PLAYER = 'player';

    private function getRank(): int
    {
        return match ($this) {
            self::PLAYER => 0,
            self::ADMIN => 1,
            self::OWNER => 2,
        };
    }

    public function isAtLeast(self $role): bool
    {
        return $this->getRank() >= $role->getRank();
    }
}
