<?php

namespace App\Repository;

use App\Entity\ContenuReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContenuReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuReference[]    findAll()
 * @method ContenuReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuReference::class);
    }

    // /**
    //  * @return ContenuReference[] Returns an array of ContenuReference objects
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
    public function findOneBySomeField($value): ?ContenuReference
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
