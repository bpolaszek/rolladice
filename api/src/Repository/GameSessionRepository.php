<?php

namespace App\Repository;

use App\Entity\GameSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 *
 * @extends ServiceEntityRepository<GameSession>
 *
 * @method GameSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameSession[]    findAll()
 * @method GameSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameSession::class);
    }

    //    /**
    //     * @return GameSession[] Returns an array of GameSession objects
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

    //    public function findOneBySomeField($value): ?GameSession
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
