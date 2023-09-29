<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
#[ApiFilter(ExistsFilter::class, properties: ['startedAt'])]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?GameSession $session = null;

    #[ORM\Column(nullable: true)]
    public ?\DateTimeImmutable $startedAt = null;

    /**
     * @var array<string, mixed>
     */
    #[ORM\Column(nullable: true)]
    public ?array $state = null;

    #[ORM\Column(length: 255)]
    public ?GameStatus $status = null;
}
