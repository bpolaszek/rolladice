<?php

namespace App\Repository;

use App\Entity\ClubMember;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
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

    //    /**
    //     * @return ClubMember[] Returns an array of ClubMember objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ClubMember
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
