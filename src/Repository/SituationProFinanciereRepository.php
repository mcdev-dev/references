<?php

namespace App\Repository;

use App\Entity\SituationProFinanciere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SituationProFinanciere|null find($id, $lockMode = null, $lockVersion = null)
 * @method SituationProFinanciere|null findOneBy(array $criteria, array $orderBy = null)
 * @method SituationProFinanciere[]    findAll()
 * @method SituationProFinanciere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituationProFinanciereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SituationProFinanciere::class);
    }

    // /**
    //  * @return SituationProFinanciere[] Returns an array of SituationProFinanciere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SituationProFinanciere
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
