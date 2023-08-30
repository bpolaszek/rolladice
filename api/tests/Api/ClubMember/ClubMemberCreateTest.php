<?php

namespace App\Tests\Api\ClubMember;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\AuthenticatedClient;
use App\Tests\Factory\UserFactory;
use Symfony\Component\HttpFoundation\Response;

use function App\Tests\Alice;
use function App\Tests\Chessy;
use function sprintf;

class ClubMemberCreateTest extends ApiTestCase
{
    use AuthenticatedClient;

    public function testAnonymousUsersCannotAddMembers(): void
    {
        $api = $this->createClient();
        $api->request('POST', '/club_members', [
            'json' => [
                'club' => sprintf('/clubs/%d', Chessy()->id),
                'member' => sprintf('/users/%d', Alice()->id),
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
                'club' => sprintf('/clubs/%d', Chessy()->id),
                'member' => sprintf('/users/%d', Alice()->id),
            ],
        ]);

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }
}
