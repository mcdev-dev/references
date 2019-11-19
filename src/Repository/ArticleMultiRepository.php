<?php

namespace App\Repository;

use App\Entity\ArticleMulti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticleMulti|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleMulti|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleMulti[]    findAll()
 * @method ArticleMulti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleMultiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleMulti::class);
    }

    // /**
    //  * @return ArticleMulti[] Returns an array of ArticleMulti objects
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
    public function findOneBySomeField($value): ?ArticleMulti
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
