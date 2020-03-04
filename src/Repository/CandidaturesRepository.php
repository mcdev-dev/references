<?php

namespace App\Repository;

use App\Entity\Candidatures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Candidatures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidatures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidatures[]    findAll()
 * @method Candidatures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidatures::class);
    }

    public function findCandidatureByField($candidat)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.candidat = :candidat')
            ->setParameter('candidat', $candidat)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Candidatures[] Returns an array of Candidatures objects
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
    public function findOneBySomeField($value): ?Candidatures
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
