<?php

declare(strict_types=1);

namespace App\Security\DoctrineExtension;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Club;
use App\Entity\ClubMember;
use App\Repository\ClubMemberRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class ClubMemberExtension implements QueryCollectionExtensionInterface
{
    public function __construct(
        private Security $security,
        private ClubMemberRepository $clubMemberRepository,
    ) {
    }

    /**
     * @param array<string, mixed> $context
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        Operation $operation = null,
        array $context = [],
    ): void {
        if (ClubMember::class !== $resourceClass) {
            return;
        }

        $aliases = [
            ClubMember::class => $queryBuilder->getRootAliases()[0],
            Club::class => $queryNameGenerator->generateParameterName('clubs'),
        ];

        // AND ClubMember.club in (:clubs)
        $queryBuilder->andWhere(vsprintf('%s.club IN (:%s)', [
            $aliases[ClubMember::class],
            $aliases[Club::class],
        ]));

        $me = $this->security->getUser();
        $myMemberships = $this->clubMemberRepository->findBy(['member' => $me]);
        $myClubs = \array_column($myMemberships, 'club');

        $queryBuilder->setParameter($aliases[Club::class], $myClubs);
    }
}
