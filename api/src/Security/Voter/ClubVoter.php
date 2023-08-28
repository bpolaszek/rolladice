<?php

namespace App\Security\Voter;

use App\Entity\Club;
use App\Entity\ClubMemberRole;
use App\Entity\User;
use App\Repository\ClubMemberRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<string, Club>
 */
class ClubVoter extends Voter
{
    public function __construct(
        private readonly ClubMemberRepository $repository,
    ) {
    }

    /**
     * @param Club $subject
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Club
            && \str_starts_with($attribute, 'club:');
    }

    /**
     * @param Club $club
     */
    protected function voteOnAttribute(string $attribute, mixed $club, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        $membership = $this->repository->findOneBy([
            'club' => $club,
            'member' => $user,
        ]);

        // no arms, no chocolate 🍫
        if (!$membership) {
            return false;
        }

        return match ($attribute) {
            Club::UPDATE => $membership->role?->isAtLeast(ClubMemberRole::OWNER),
            default => false,
        };
    }
}
