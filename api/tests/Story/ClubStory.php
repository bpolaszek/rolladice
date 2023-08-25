<?php

namespace App\Tests\Story;

use App\Tests\Factory\ClubFactory;
use Zenstruck\Foundry\Story;

final class ClubStory extends Story
{
    public function build(): void
    {
        $clubs = ClubFactory::createMany(3);
        $clubs[0]->name = 'The Morbaks';
    }
}
