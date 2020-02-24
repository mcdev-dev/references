<?php

namespace App\Repository;

use App\Entity\CreditsEnCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CreditsEnCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditsEnCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditsEnCours[]    findAll()
 * @method CreditsEnCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditsEnCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditsEnCours::class);
    }

    // /**
    //  * @return CreditsEnCours[] Returns an array of CreditsEnCours objects
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
    public function findOneBySomeField($value): ?CreditsEnCours
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
