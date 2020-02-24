<?php

namespace App\Repository;

use App\Entity\ContenuMultiple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContenuMultiple|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuMultiple|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuMultiple[]    findAll()
 * @method ContenuMultiple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuMultipleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuMultiple::class);
    }

    // /**
    //  * @return ContenuMultiple[] Returns an array of ContenuMultiple objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContenuMultiple
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
