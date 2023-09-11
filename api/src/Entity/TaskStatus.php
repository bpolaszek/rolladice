<?php

declare(strict_types=1);

namespace App\Entity;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in-progress';
    case COMPLETE = 'complete';
    case FAILED = 'failed';
}
