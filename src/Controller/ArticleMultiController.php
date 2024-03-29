<?php

namespace App\Controller;

use App\Entity\ArticleMulti;
use App\Form\ArticleMultiType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleMultiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleMultiController extends AbstractController
{
    /**
     * @Route("/admin/article/liste", name="article_multi")
     * Route d'affichage d'articles
     */
    public function index(ArticleMultiRepository $repo)
    {
        $photos = null;
        return $this->render('article_multi/articles_multi_list.html.twig', 
        [
            'articlesMulti' => $repo->findAll(),
            'photos' => $photos,
        ]);
    }

    /**
     * @Route("/article/photos/{id}", name="autre_photos")
     * Route d'affichage des autres photos
     */
    public function otherPhotos($id, ArticleMulti $article) 
    {
        return $this->render('article_multi/articles_autre_photos.html.twig', 
        [
            'photos' => $article,
        ]);

    }

    /**
     * @Route("/admin/article/multi/add", name="article_multi_add")
     * Route d'ajout d'un article
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addArticle(Request $request, EntityManagerInterface $manager)
    {
        $article = new ArticleMulti;
        $form = $this->createForm(ArticleMultiType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            foreach($article->getImages() as $image) {
                $image->setArticleMulti($article);
                $manager->persist($image);
            }

            foreach($article->getContenu() as $contenu) {
                $contenu->setArticleMulti($article);
                $manager->persist($contenu);
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
     * @Route("/admin/article/multi/update/{id}", name="article_multi_update")
     * Route de modification d'un article
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateArticle($id, EntityManagerInterface $manager, ArticleMultiRepository $repo, Request $request) 
    {
        $article = $repo->find($id);
        $form = $this->createForm(ArticleMultiType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            foreach($article->getImages() as $image) {
                $image->setArticleMulti($article);
                $manager->persist($image);
            }

            foreach($article->getContenu() as $contenu) {
                dd($contenu);
                $contenu->setArticleMulti($article);
                $manager->persist($contenu);
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
     * @Route("/admin/article/multi/delete/{id}", name="article_multi_delete")
     * Route de suppression d'un article
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteArticle($id, EntityManagerInterface $manager, ArticleMultiRepository $repo) 
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

    /**
     * @Route("/habitat-participatif/projet/{id}", name="habitat_participatif_projet")
     * Route d'affichage du projet
     */
    public function projetAction($id, ArticleMulti $articleMulti) 
    {
        return $this->render('article_multi/habitat_participatif_projet.html.twig', [
            'articleMulti' => $articleMulti
        ]);
    }

}
