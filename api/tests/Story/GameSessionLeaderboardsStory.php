<?php

namespace App\Tests\Story;

use App\Tests\Factory\GameSessionLeaderboardFactory;
use Zenstruck\Foundry\Story;

final class GameSessionLeaderboardsStory extends Story
{
    public function build(): void
    {
        GameSessionLeaderboardFactory::createMany(30);
    }
}
