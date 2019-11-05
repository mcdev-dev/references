<?php

namespace App\Repository;

use App\Entity\UserCoordonnees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserCoordonnees|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCoordonnees|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCoordonnees[]    findAll()
 * @method UserCoordonnees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCoordonneesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCoordonnees::class);
    }

    // /**
    //  * @return UserCoordonnees[] Returns an array of UserCoordonnees objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCoordonnees
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
