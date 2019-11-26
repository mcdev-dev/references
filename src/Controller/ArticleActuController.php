<?php

namespace App\Controller;

use App\Entity\ArticleActu;
use App\Form\ArticleActuType;
use App\Repository\ArticleActuRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleActuController extends AbstractController
{
    /**
     * @Route("/article/viewActualites", name="article_actu")
     */
    public function index(ArticleActuRepository $articleRepo)
    {
        $articles = $articleRepo->findByDesc();

        return $this->render('article_actu/liste_article.html.twig', 
        [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/actualites/", name="articles_actualites")
     * Route d'affichage de toute l'actualité
     */
    public function articlesActualites(ArticleActuRepository $repo) 
    {
        return $this->render('article_actu/actualites_all.html.twig', 
        [
            'articles' => $repo->getCategorie('actualites')
        ]);
    }

    /**
     * @Route("/actualites/article/{id}", name="article_actualite")
     * Route d'affichage de l'article de la catégorie Actualités
     */
    public function actualite(int $id, ArticleActu $article) 
    {
        return $this->render('article_actu/actualite.html.twig', 
        [
            'article' => $article
        ]);
    }

    /**
     * @Route("/actualites/add", name="article_actu_add")
     */
    public function addArticle(Request $request, ObjectManager $manager) 
    {
        $article = new ArticleActu;
        $form = $this->createForm(ArticleActuType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $article->setCreateAt(new \DateTime);
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'actualité <strong>' . $article->getTitre() . '</strong> a été ajoutée avec succès.');

            return $this->redirectToRoute('article_actu');
        }
        
        return $this->render('article_actu/article_crud.html.twig', 
        [
            'action' => 'Ajouter',
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/actualites/update/{id}", name="article_actu_update")
     */
    public function updateArticle($id, Request $request, ArticleActuRepository $articleRepo, ObjectManager $manager) 
    {
        $article = $articleRepo->find($id);
        $form = $this->createForm(ArticleActuType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'L\'actualité <strong>' . $article->getTitre() . '</strong> a été modifiée avec succès.');

            return $this->redirectToRoute('article_actu');
        }

        return $this->render('article_actu/article_crud.html.twig', [
            'action' => 'Modifier',
            'id' => $id,
            'articleForm' => $form->createView()

        ]);

    }

    /**
     * @Route("/actualites/delete/{id}", name="article_actu_delete")
     */
    public function articleDelete($id, ArticleActuRepository $articleRepo, ObjectManager $manager) 
    {
        $article = $articleRepo->find($id);
        if($article) {
            $manager->remove($article);
            $manager->flush();

            $this->addFlash('success', 'L\'actualité <strong>' . $article->getTitre() . '</strong> a été supprimée avec succès.');
            return $this->redirectToRoute('article_actu');
        }
    }

    /**
     * @Route("/article/search", name="article_search")
     * 
     */
    public function searchArticle(ArticleActuRepository $repo, Request $request)
    { 
        $query = preg_replace('#[^a-zA-Z ?0-9]#i', '', $request->get('query'));
        $results = $repo->searchArticle($query);
        
        if($request->isXmlHttpRequest()) 
        {
            $content = $this->renderView('article_actu/search_ajax.html.twig', [
                'saisie' => $query,
                'results' => $results
            ]);
            
            if(count($results) > 0) {
                return new JsonResponse([
                    'results' => $content
                ], 200);
            } else {
                return new JsonResponse([
                    'errors' => '<strong>Désolé !</strong> Aucun résultat trouvé.'
                ]);
            }

        } else 
        {
            if($request->getMethod() == 'POST') 
            {
                return $this->render('article_actu/search_results.html.twig', 
                    [
                        'saisie' => $query,
                        'response' => $results,
                        'nbResponse' => count($results)
                    ]);
            } else {
                throw $this->createNotFoundException('Aïe! La Page n\'existe pas !');
            }

        }
        

    }

}
