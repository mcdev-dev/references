<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class Stats 
{
    private $manager;

    public function __construct(EntityManagerInterface $manager) 
    {
        $this->manager = $manager;
    }

    public function getStats() 
    {
        $users          = $this->getUsersCount();
        $articles       = $this->getArticlesCount();
        $actus          = $this->getActusCount();
        $candidatures   = $this->getCandidaturesCount();

        return compact('users', 'articles', 'actus', 'candidatures');
    }

    public function getUsersCount() 
    {
        return $this->manager->createQuery('SELECT count(u) FROM App\Entity\User u')->getSingleScalarResult();
    }

    public function getArticlesCount() 
    {
        return $this->manager->createQuery('SELECT count(a) FROM App\Entity\Article a')->getSingleScalarResult();
    }

    public function getActusCount() 
    {
        return $this->manager->createQuery('SELECT count(n) FROM App\Entity\ArticleActu n')->getSingleScalarResult();
    }

    public function getCandidaturesCount() 
    {
        return $this->manager->createQuery('SELECT count(c) FROM App\Entity\JoinUs c')->getSingleScalarResult();
    }

}