<?php

namespace App\Tests\Api\Club;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ClubCollectionTest extends ApiTestCase
{
    public function testItReturnsTheClubCollection(): void
    {
        static::createClient()->request('GET', '/clubs');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@context' => '/contexts/Club',
            '@id' => '/clubs',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 5,
        ]);
    }
}
