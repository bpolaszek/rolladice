<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\State\GameRenewalProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

#[ORM\Entity]
#[GetCollection, Get, Post(
    uriTemplate: '/tasks/game/renew',
    input: Game::class,
    processor: GameRenewalProcessor::class,
    status: Response::HTTP_ACCEPTED,
)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column]
    public \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    public ?\DateTimeImmutable $terminatedAt = null;

    #[ORM\Column(length: 255)]
    public TaskType $type;

    #[ORM\Column(length: 255)]
    public TaskStatus $status = TaskStatus::PENDING;

    public object $payload;
}
