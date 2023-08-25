<?php

namespace App\DataFixtures;

use App\Tests\Story\ClubMemberStory;
use App\Tests\Story\ClubStory;
use App\Tests\Story\GameLeaderboardsStory;
use App\Tests\Story\GameSessionLeaderboardsStory;
use App\Tests\Story\GameSessionsStory;
use App\Tests\Story\GamesStory;
use App\Tests\Story\UsersStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ClubStory::load();
        UsersStory::load();
        ClubMemberStory::load();
        GameSessionsStory::load();
        GameSessionLeaderboardsStory::load();
        GamesStory::load();
        GameLeaderboardsStory::load();

        $manager->flush();
    }
}
