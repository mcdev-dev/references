<?php

namespace App\Repository;

use App\Entity\InteretHabitatParticipatif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InteretHabitatParticipatif|null find($id, $lockMode = null, $lockVersion = null)
 * @method InteretHabitatParticipatif|null findOneBy(array $criteria, array $orderBy = null)
 * @method InteretHabitatParticipatif[]    findAll()
 * @method InteretHabitatParticipatif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InteretHabitatParticipatifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InteretHabitatParticipatif::class);
    }

    // /**
    //  * @return InteretHabitatParticipatif[] Returns an array of InteretHabitatParticipatif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InteretHabitatParticipatif
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
