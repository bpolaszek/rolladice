<?php

namespace App\Tests\Story;

use App\Tests\Factory\ClubFactory;
use App\Tests\Factory\ClubMemberFactory;
use App\Tests\Factory\UserFactory;
use Zenstruck\Foundry\Story;

final class ClubMemberStory extends Story
{
    public function build(): void
    {
        ClubMemberFactory::createMany(10, fn () => [
            'club' => ClubFactory::random(),
            'member' => UserFactory::random(),
        ]);
    }
}
