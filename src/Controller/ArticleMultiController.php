<?php

namespace App\Controller;

use App\Entity\ArticleMulti;
use App\Form\ArticleMultiType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleMultiController extends AbstractController
{
    /**
     * @Route("/article/multi", name="article_multi")
     */
    public function index()
    {
        return $this->render('article_multi/index.html.twig', [
            'controller_name' => 'ArticleMultiController',
        ]);
    }

    /**
     * @Route("/article/multi/add", name="article_multi_add")
     * Route d'ajout d'un article
     */
    public function addArticle(Request $request, ObjectManager $manager)
    {
        $article = new ArticleMulti;
        $form = $this->createForm(ArticleMultiType::class, $article);
        $form->handleRequest($request);

        return $this->render(
            'article_multi/article_multi_crud.html.twig',
            [
                'action' => 'Ajouter',
                'articleMultiForm' => $form->createView(),
            ]
        );
    }
}
