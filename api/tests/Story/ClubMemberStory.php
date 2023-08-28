<?php

namespace App\Tests\Story;

use App\Entity\ClubMemberRole;
use App\Tests\Factory\ClubFactory;
use App\Tests\Factory\ClubMemberFactory;
use App\Tests\Factory\UserFactory;
use Zenstruck\Foundry\Story;

final class ClubMemberStory extends Story
{
    public function build(): void
    {
        ClubMemberFactory::createOne([
            'club' => ClubFactory::find(['name' => 'Triangles']),
            'member' => UserFactory::find(['email' => 'bob@example.com']),
            'role' => ClubMemberRole::OWNER,
        ]);
        ClubMemberFactory::createOne([
            'club' => ClubFactory::find(['name' => 'Triangles']),
            'member' => UserFactory::find(['email' => 'alice@example.com']),
            'role' => ClubMemberRole::ADMIN,
        ]);
        ClubMemberFactory::createOne([
            'club' => ClubFactory::find(['name' => 'Chessy']),
            'member' => UserFactory::find(['email' => 'bob@example.com']),
            'role' => ClubMemberRole::PLAYER,
        ]);
        ClubMemberFactory::createMany(10);
    }
}
