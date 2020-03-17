<?php

namespace App\Repository;

use App\Entity\MediaReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediaReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaReference[]    findAll()
 * @method MediaReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaReference::class);
    }

    // /**
    //  * @return MediaContenu[] Returns an array of MediaContenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MediaContenu
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
