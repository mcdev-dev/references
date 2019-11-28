<?php

namespace App\Repository;

use App\Entity\JoinUs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JoinUs|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoinUs|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoinUs[]    findAll()
 * @method JoinUs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoinUsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoinUs::class);
    }

    // /**
    //  * @return JoinUs[] Returns an array of JoinUs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JoinUs
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
