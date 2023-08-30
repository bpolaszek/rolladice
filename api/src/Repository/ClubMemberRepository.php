<?php

namespace App\Repository;

use App\Entity\Club;
use App\Entity\ClubMember;
use App\Entity\ClubMemberRole;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 * @extends ServiceEntityRepository<ClubMember>
 *
 * @method ClubMember|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubMember|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubMember[]    findAll()
 * @method ClubMember[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubMemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubMember::class);
    }

    public function findRole(Club $club, User $user): ?ClubMemberRole
    {
        return $this->findOneBy(['club' => $club, 'member' => $user])?->role;
    }
}
