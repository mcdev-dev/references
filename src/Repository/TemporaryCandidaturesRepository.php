<?php

namespace App\Repository;

use App\Entity\TemporaryCandidatures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TemporaryCandidatures|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemporaryCandidatures|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemporaryCandidatures[]    findAll()
 * @method TemporaryCandidatures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemporaryCandidaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemporaryCandidatures::class);
    }

    // /**
    //  * @return TemporaryCandidatures[] Returns an array of TemporaryCandidatures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TemporaryCandidatures
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
