<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameSessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameSessionRepository::class)]
#[ApiResource]
class GameSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?Club $club = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    public ?\DateTimeImmutable $day = null;

    #[ORM\Column]
    public ?int $iteration = null;

    #[ORM\Column(length: 255)]
    public ?string $status = null;
}
