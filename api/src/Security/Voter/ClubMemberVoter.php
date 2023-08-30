<?php

namespace App\Security\Voter;

use App\Entity\Club;
use App\Entity\ClubMember;
use App\Entity\ClubMemberRole;
use App\Entity\User;
use App\Repository\ClubMemberRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * @extends Voter<string, ClubMember>
 */
class ClubMemberVoter extends Voter
{
    public function __construct(
        private readonly ClubMemberRepository $repository,
    ) {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof ClubMember
            && \str_starts_with($attribute, 'club-member:');
    }

    protected function voteOnAttribute(string $attribute, mixed $clubMember, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            ClubMember::VIEW => $this->userCanSeeMember($user, $clubMember),
            ClubMember::CREATE => $this->userCanAddMember($user, $clubMember),
            default => false,
        };
    }

    private function userCanSeeMember(User $me, ClubMember $otherMember): bool
    {
        /** @var Club $club */
        $club = $otherMember->club;
        $myRole = $this->repository->findRole($club, $me);

        return null !== $myRole;
    }

    private function userCanAddMember(User $me, ClubMember $membershipToBeAdded): bool
    {
        /** @var Club $club */
        $club = $membershipToBeAdded->club;
        $myRole = $this->repository->findRole($club, $me);

        // Not even member 🚷
        if (null === $myRole) {
            return false;
        }

        return $myRole->isAtLeast(ClubMemberRole::ADMIN)
            && $membershipToBeAdded->role->isAtMost($myRole);
    }
}
