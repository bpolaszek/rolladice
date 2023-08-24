<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?GameSession $session = null;

    #[ORM\Column]
    public ?\DateTimeImmutable $startedAt = null;

    /**
     * @var array<string, mixed>
     */
    #[ORM\Column(nullable: true)]
    public ?array $state = null;

    #[ORM\Column(length: 255)]
    public ?string $status = null;
}
