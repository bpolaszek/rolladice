<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\ClubMemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubMemberRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(security: 'is_granted("'.self::VIEW.'", object)'),
        new Post(securityPostDenormalize: 'is_granted("'.self::CREATE.'", object)'),
    ]
)]
class ClubMember
{
    public const VIEW = 'club-member:view';
    public const CREATE = 'club-member:create';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?Club $club = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?User $member = null;

    #[ORM\Column]
    public ?ClubMemberRole $role = null;
}
