<?php

namespace App\Tests\Api\ClubMember;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\ClubMemberRole;
use App\Repository\ClubMemberRepository;
use App\Tests\Api\AuthenticatedClient;
use App\Tests\Factory\ClubMemberFactory;
use App\Tests\Factory\UserFactory;
use Symfony\Component\HttpFoundation\Response;

use function App\Tests\Bob;
use function App\Tests\Chessy;
use function App\Tests\Triangles;

class ClubMemberViewTest extends ApiTestCase
{
    use AuthenticatedClient;

    public function testARandomUserCannotSeeOtherMembersOfAClubTheyDoNotBelongTo(): void
    {
        /** @var ClubMemberRepository $repository */
        $repository = static::getContainer()->get(ClubMemberRepository::class);

        $user = ClubMemberFactory::createOne([
            'club' => Chessy(),
            'member' => UserFactory::createOne(),
            'role' => ClubMemberRole::PLAYER,
        ])->object()->member;

        $bobsTrianglesMembership = $repository->findOneBy(['club' => Triangles(), 'member' => Bob()]);

        $api = $this->as($user);
        $api->request('GET', \sprintf('/club_members/%d', $bobsTrianglesMembership->id));

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testARandomUserCanSeeOtherMembersOfAClubTheyBelongTo(): void
    {
        /** @var ClubMemberRepository $repository */
        $repository = static::getContainer()->get(ClubMemberRepository::class);

        $user = ClubMemberFactory::createOne([
            'club' => Triangles(),
            'member' => UserFactory::createOne(),
            'role' => ClubMemberRole::PLAYER,
        ])->object()->member;

        $bobsTrianglesMembership = $repository->findOneBy(['club' => Triangles(), 'member' => Bob()]);

        $api = $this->as($user);
        $api->request('GET', \sprintf('/club_members/%d', $bobsTrianglesMembership->id));

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
