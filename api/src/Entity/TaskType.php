<?php

declare(strict_types=1);

namespace App\Entity;

enum TaskType: string
{
    case GAME_RENEWAL = 'game:renew';
}
