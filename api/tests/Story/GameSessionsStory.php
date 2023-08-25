<?php

namespace App\Tests\Story;

use App\Tests\Factory\GameSessionFactory;
use Zenstruck\Foundry\Story;

final class GameSessionsStory extends Story
{
    public function build(): void
    {
        GameSessionFactory::createMany(30);
    }
}
