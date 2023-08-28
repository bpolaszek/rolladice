<?php

namespace App\Tests\Api\Club;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\AuthenticatedClient;
use App\Tests\Factory\UserFactory;
use Symfony\Component\HttpFoundation\Response;

use function App\Tests\Alice;
use function App\Tests\Bob;
use function App\Tests\Triangles;

class ClubUpdateTest extends ApiTestCase
{
    use AuthenticatedClient;

    public function testAnonymousUsersAreNotAllowedToUpdateTrianglesName(): void
    {
        $api = $this->createClient();
        $api->request('PUT', \sprintf('/clubs/%d', Triangles()->id), [
            'json' => [
                'name' => 'Triangles and Circles',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testSomeRandomUserIsNotAllowedToUpdateTrianglesName(): void
    {
        $user = UserFactory::createOne(['email' => 'random.user@example.com'])->object();
        $api = $this->as($user);
        $api->request('PUT', \sprintf('/clubs/%d', Triangles()->id), [
            'json' => [
                'name' => 'Triangles and Circles',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAliceIsNotAllowedToUpdateTrianglesName(): void
    {
        $api = $this->as(Alice());
        $api->request('PUT', \sprintf('/clubs/%d', Triangles()->id), [
            'json' => [
                'name' => 'Triangles and Circles',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testBobIsAllowedToUpdateTrianglesName(): void
    {
        $api = $this->as(Bob());
        $api->request('PUT', \sprintf('/clubs/%d', Triangles()->id), [
            'json' => [
                'name' => 'Triangles and Circles',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'name' => 'Triangles and Circles',
        ]);
    }
}
