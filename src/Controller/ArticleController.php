<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/article/viewAll", name="article")
     */
    public function index(ArticleRepository $articleRepo)
    {
        return $this->render('article/liste_article.html.twig', 
        [
            'articles' => $articleRepo->findByDesc(),
        ]);
    }

    /**
     * @Route("/admin/article/add", name="article_add")
     */
    public function addArticle(Request $request, ObjectManager $manager) 
    {
        $article = new Article;
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $article->setCreateAt(new \DateTime);
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été ajoutée avec succès.');

            return $this->redirectToRoute('article');
        }
        
        return $this->render('article/article_crud.html.twig', 
        [
            'action' => 'Ajouter',
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/update/{id}", name="article_update")
     */
    public function updateArticle($id, Request $request, Article $article, ObjectManager $manager) 
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été modifié avec succès.');

            return $this->redirectToRoute('article');
        }

        return $this->render('article/article_crud.html.twig', [
            'action' => 'Modifier',
            'articleForm' => $form->createView()

        ]);

    }

    /**
     * @Route("/admin/article/delete/{id}", name="article_delete")
     */
    public function articleDelete($id, Article $article, ObjectManager $manager) 
    {
        if(null !== $article) {
            $manager->remove($article);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $article->getTitre() . '</strong> a été supprimé avec succès.');
            return $this->redirectToRoute('article');
        }
    }


}
