<?php

namespace App\Repository;

use App\Entity\Maison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Maison>
 */
class MaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maison::class);
    }

    public function getMaisonsClassementParPoints(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m.nom AS nom, SUM(h.nbPoint) AS totalPoints')
            ->leftJoin('m.eleves', 'e')
            ->leftJoin('e.historiquePoints', 'h')
            ->groupBy('m.id')
            ->orderBy('totalPoints', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Maison[] Returns an array of Maison objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Maison
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
