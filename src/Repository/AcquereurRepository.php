<?php

namespace App\Repository;

use App\Entity\Acquereur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Acquereur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acquereur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acquereur[]    findAll()
 * @method Acquereur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcquereurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acquereur::class);
    }

    // /**
    //  * @return Acquereur[] Returns an array of Acquereur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acquereur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
