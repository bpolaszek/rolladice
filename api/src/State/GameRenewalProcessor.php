<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Game;
use App\Entity\GameSession;
use App\Entity\GameStatus;
use App\Entity\Task;
use App\Entity\TaskStatus;
use App\Entity\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @implements ProcessorInterface<Task>
 */
#[AsMessageHandler]
readonly class GameRenewalProcessor implements ProcessorInterface
{
    public function __construct(
        private PersistProcessor $persistProcessor,
        private MessageBusInterface $messageBus,
        private EntityManagerInterface $manager,
    ) {
    }

    /**
     * @param Game $game
     */
    public function process(mixed $game, Operation $operation, array $uriVariables = [], array $context = []): Task
    {
        $task = new Task();
        $task->payload = $game->session;
        $task->createdAt = new \DateTimeImmutable();
        $task->type = TaskType::GAME_RENEWAL;

        $this->persistProcessor->process($task, $operation, $uriVariables, $context);
        $this->messageBus->dispatch($task);

        return $task;
    }

    public function __invoke(Task $task): void
    {
        // @phpstan-ignore-next-line
        if (TaskType::GAME_RENEWAL !== $task->type) {
            return; // @codeCoverageIgnore
        }

        /** @var GameSession $session */
        $session = $task->payload;

        $game = new Game();
        $game->session = $session;
        $game->status = GameStatus::RUNNING;
        $game->startedAt = new \DateTimeImmutable();
        $this->manager->persist($game);

        $task->status = TaskStatus::COMPLETE;
        $task->terminatedAt = new \DateTimeImmutable();

        $this->manager->flush();
    }
}
