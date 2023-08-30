<?php

namespace App\Tests\Api\ClubMember;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\AuthenticatedClient;
use App\Tests\Factory\UserFactory;
use Symfony\Component\HttpFoundation\Response;

use function App\Tests\Alice;
use function App\Tests\Bob;
use function App\Tests\Chessy;
use function App\Tests\Triangles;

class ClubMemberCreateTest extends ApiTestCase
{
    use AuthenticatedClient;

    public function testAnonymousUsersCannotAddMembers(): void
    {
        $api = $this->createClient();
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Chessy()->id),
                'member' => \sprintf('/users/%d', Alice()->id),
                'role' => 'player',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testSomeRandomUserCannotAddMembers(): void
    {
        $user = UserFactory::createOne(['email' => 'random.user@example.com'])->object();
        $api = $this->as($user);
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Chessy()->id),
                'member' => \sprintf('/users/%d', Alice()->id),
                'role' => 'player',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testBobIsNotPrivilegedEnoughToAddMembersToChessy(): void
    {
        $api = $this->as(Bob()); // Bob is a regular player of Chessy
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Chessy()->id),
                'member' => \sprintf('/users/%d', Alice()->id),
                'role' => 'player',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAliceCanAddMembersToTriangles(): void
    {
        $user = UserFactory::createOne();
        $api = $this->as(Alice()); // Alice is Admin of Triangles
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Triangles()->id),
                'member' => \sprintf('/users/%d', $user->id),
                'role' => 'player',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testBobCanAddMembersToTriangles(): void
    {
        $user = UserFactory::createOne();
        $api = $this->as(Bob()); // Bob is Owner of Triangles
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Triangles()->id),
                'member' => \sprintf('/users/%d', $user->id),
                'role' => 'player',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testAliceCannotAddAnOwnerToTriangles(): void
    {
        $user = UserFactory::createOne();
        $api = $this->as(Alice()); // Alice is Admin of Triangles
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => \sprintf('/clubs/%d', Triangles()->id),
                'member' => \sprintf('/users/%d', $user->id),
                'role' => 'owner',
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }
}
