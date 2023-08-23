<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
#[ApiResource]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'club', targetEntity: ClubMember::class, orphanRemoval: true)]
    private Collection $members;

    #[ORM\OneToMany(mappedBy: 'club', targetEntity: GameSession::class, orphanRemoval: true)]
    private Collection $sessions;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ClubMember>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(ClubMember $member): static
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setClub($this);
        }

        return $this;
    }

    public function removeMember(ClubMember $member): static
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getClub() === $this) {
                $member->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameSession>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(GameSession $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setClub($this);
        }

        return $this;
    }

    public function removeSession(GameSession $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getClub() === $this) {
                $session->setClub(null);
            }
        }

        return $this;
    }
}
