<?php

namespace App\Controller;

use App\Entity\ArticleMulti;
use App\Form\ArticleMultiType;
use App\Repository\ArticleMultiRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleMultiController extends AbstractController
{
    /**
     * @Route("/article/liste", name="article_multi")
     * Route d'affichage d'articles
     */
    public function index(ArticleMultiRepository $repo)
    {
        return $this->render('article_multi/articles_multi_list.html.twig', 
        [
            'articlesMulti' => $articles = $repo->findAll(),
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

        if($form->isSubmitted() && $form->isValid()) 
        {
            $images = $article->getImages();
            foreach($images as $key => $value) {
                $value->setArticleMulti($article);
                $images->set($key, $value);
            }

            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été ajouté avec succès.');
            return $this->redirectToRoute('article_multi');
        }

        return $this->render(
            'article_multi/article_multi_crud.html.twig',
            [
                'action' => 'Ajouter',
                'article' => $article,
                'articleMultiForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/article/multi/update/{id}", name="article_multi_update")
     * Route de modification d'un article
     */
    public function updateArticle($id, ObjectManager $manager, ArticleMultiRepository $repo, Request $request) 
    {
        $article = $repo->find($id);
        $form = $this->createForm(ArticleMultiType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $images = $article->getImages();
            foreach($images as $key => $value) {
                $value->setArticleMulti($article);
                $images->set($key, $value);
            }

            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été modifié avec succès.');
            return $this->redirectToRoute('article_multi');
        }

        return $this->render(
            'article_multi/article_multi_crud.html.twig',
            [
                'action' => 'Modifier',
                'id' => $id,
                'article' => $article,
                'articleMultiForm' => $form->createView(),
            ]
        );

    }

    /**
     * @Route("/article/multi/delete/{id}", name="article_multi_delete")
     * Route de suppression d'un article
     */
    public function deleteArticle($id, ObjectManager $manager, ArticleMultiRepository $repo) 
    {
        $article = $repo->find($id);

        if($article) 
        {
            $manager->remove($article);
            $manager->flush();
            
            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été supprimé avec succès.');
        }

        return $this->redirectToRoute('article_multi');
    }

}
