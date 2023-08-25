<?php

declare(strict_types=1);

namespace App\Entity;

enum GameStatus: string
{
    case RUNNING = 'running';
    case COMPLETED = 'completed';
}
