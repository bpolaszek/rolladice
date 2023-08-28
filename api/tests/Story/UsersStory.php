<?php

namespace App\Tests\Story;

use App\Tests\Factory\UserFactory;
use Zenstruck\Foundry\Story;

final class UsersStory extends Story
{
    public function build(): void
    {
        UserFactory::createOne(['email' => 'bob@example.com']);
        UserFactory::createOne(['email' => 'alice@example.com']);
        UserFactory::createMany(8);
    }
}
