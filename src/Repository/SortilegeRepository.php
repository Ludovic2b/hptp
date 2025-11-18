<?php

namespace App\Repository;

use App\Entity\Sortilege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortilege>
 */
class SortilegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortilege::class);
    }

       /**
        * @return Sortilege[] Returns an array of Sortilege objects
        */
       public function findByEleve($archive): array
       {
           return $this->createQueryBuilder('s')
               ->select("s.nom as nom,s.id as id, COUNT(e.id) as nbApprenant")
               ->leftJoin("s.eleves","e")
               ->andWhere('s.archive = :val')
               ->setParameter('val', $archive)
               ->orderBy('nbApprenant', 'DESC')
               ->groupBy("s.nom,s.id")
               //->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Sortilege
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
