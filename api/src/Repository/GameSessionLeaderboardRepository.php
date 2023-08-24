<?php

namespace App\Repository;

use App\Entity\GameSessionLeaderboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 *
 * @extends ServiceEntityRepository<GameSessionLeaderboard>
 *
 * @method GameSessionLeaderboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameSessionLeaderboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameSessionLeaderboard[]    findAll()
 * @method GameSessionLeaderboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameSessionLeaderboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameSessionLeaderboard::class);
    }

    //    /**
    //     * @return GameSessionLeaderboard[] Returns an array of GameSessionLeaderboard objects
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

    //    public function findOneBySomeField($value): ?GameSessionLeaderboard
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
