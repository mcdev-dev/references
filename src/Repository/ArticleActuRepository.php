<?php

namespace App\Repository;

use App\Entity\ArticleActu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method ArticleActu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleActu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleActu[]    findAll()
 * @method ArticleActu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleActuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleActu::class);
    }

    public function searchArticle($titre)
    {
        return $this->createQueryBuilder('a')
        ->where('a.titre LIKE :titre')
        ->setParameter( 'titre', "%$titre%")
        ->orderBy('a.titre', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }

    public function getCategorie($value) 
    {
        return $this->createQueryBuilder('a')
        ->select('a', 'c')
        ->distinct(true)
        ->orderBy('a.id', 'DESC')
        ->join('a.categorie', 'c')
        ->andWhere('c.title = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getResult();
    }

    public function findByDesc()
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.createAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ArticleActu[] Returns an array of ArticleActu objects
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
    public function findOneBySomeField($value): ?ArticleActu
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
