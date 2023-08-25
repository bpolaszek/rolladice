<?php

namespace App\Tests\Story;

use App\Tests\Factory\GameLeaderboardFactory;
use Zenstruck\Foundry\Story;

final class GameLeaderboardsStory extends Story
{
    public function build(): void
    {
        GameLeaderboardFactory::createMany(100);
    }
}
