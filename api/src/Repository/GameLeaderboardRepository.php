<?php

namespace App\Repository;

use App\Entity\GameLeaderboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 *
 * @extends ServiceEntityRepository<GameLeaderboard>
 *
 * @method GameLeaderboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameLeaderboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameLeaderboard[]    findAll()
 * @method GameLeaderboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameLeaderboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameLeaderboard::class);
    }

    //    /**
    //     * @return GameLeaderboard[] Returns an array of GameLeaderboard objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GameLeaderboard
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
