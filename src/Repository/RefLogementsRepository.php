<?php

namespace App\Repository;

use App\Entity\RefLogements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RefLogements|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefLogements|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefLogements[]    findAll()
 * @method RefLogements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefLogementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefLogements::class);
    }

    // /**
    //  * @return RefLogements[] Returns an array of RefLogements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RefLogements
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
