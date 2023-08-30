<?php

namespace App\Security\Voter;

use App\Entity\Club;
use App\Entity\ClubMember;
use App\Entity\ClubMemberRole;
use App\Entity\User;
use App\Repository\ClubMemberRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use function str_starts_with;

class ClubMemberVoter extends Voter
{
    public function __construct(
        private readonly ClubMemberRepository $repository,
    ) {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof ClubMember
            && str_starts_with($attribute, 'club-member:');
    }

    protected function voteOnAttribute(string $attribute, mixed $clubMember, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            ClubMember::CREATE => $this->userCanAddMember($user, $clubMember),
            default => false,
        };
    }

    private function userCanAddMember(User $me, ClubMember $member): bool
    {
        /** @var Club $club */
        $club = $member->club;

        $role = $this->repository->findRole($club, $me);

        // Not even member 🚷
        if (null === $role) {
            return false;
        }

        return $role->isAtLeast(ClubMemberRole::ADMIN);
    }
}
