<?php

declare(strict_types=1);

namespace App\Entity;

enum GameSessionStatus: string
{
    case RUNNING = 'running';
    case COMPLETED = 'completed';
}
