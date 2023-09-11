<?php

namespace App\Tests\Api\Task;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\GameSession;
use App\Entity\TaskStatus;
use App\Entity\TaskType;
use App\Tests\Api\AuthenticatedClient;
use App\Tests\Factory\GameFactory;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

use function App\Tests\Bob;

class GameRenewTaskTest extends ApiTestCase
{
    use Factories;
    use AuthenticatedClient;
    use InteractsWithMessenger;

    public function testItRegistersATask(): void
    {
        // Given
        $game = GameFactory::random()->object();

        // When
        $json = $this->as(Bob())->request('POST', '/tasks/game/renew', [
            'json' => [
                'session' => $this->findIriBy(GameSession::class, ['id' => $game->session->id]),
            ],
        ])->toArray();

        // Then
        self::assertResponseStatusCodeSame(Response::HTTP_ACCEPTED);
        self::assertJsonContains([
            '@context' => '/contexts/Task',
            '@type' => 'Task',
            'type' => TaskType::GAME_RENEWAL->value,
            'status' => TaskStatus::PENDING->value,
        ]);
        $this->transport()->queue()->assertCount(1);

        // When
        $this->transport()->process(1);
        $this->as(Bob())->request('GET', $json['@id']);

        // Then
        self::assertJsonContains([
            '@context' => '/contexts/Task',
            '@type' => 'Task',
            '@id' => $json['@id'],
            'id' => $json['id'],
            'type' => TaskType::GAME_RENEWAL->value,
            'status' => TaskStatus::COMPLETE->value,
        ]);
    }
}
