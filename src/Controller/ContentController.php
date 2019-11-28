<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\ArticleMultiRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * Page d'Accueil
     */
    public function index(ArticleRepository $articleRepo)
    {
        $article1 = $articleRepo->findBy([ 'titre' => 'Faire la ville avec tous' ]);
        $article2 = $articleRepo->findBy([ 'titre' => 'Fabrique urbaine collaborative' ]);
        $article3 = $articleRepo->findBy([ 'titre' => 'Habitat participatif' ]);
        //dd($article1);

        return $this->render('content/index.html.twig',
        [
            'article1' => $article1,
            'article2' => $article2,
            'article3' => $article3,
        ]);
    }

    /**
     * @Route("/fabrique_urbaine_collaborative", name="fabrique_urbaine")
     */
    public function fabriqueUrbaineCollaborative(ArticleRepository $articleRepo) 
    {
        $article = $articleRepo->findBy([ 'titre' => 'Venez participer à la Fabrique urbaine collaborative !' ]);

        return $this->render('content/fabrique_urbaine.html.twig', 
        [
            'article' => $article,
        ]);

    }

    /**
     * @Route("/habitat-participatif/plateforme", name="habitat_participatif")
     * Route d'affichage de habitat participatif
     */
    public function habitatParticipatif(ArticleMultiRepository $repo) 
    {
        return $this->render('article_multi/habitat_participatif_list.html.twig', 
        [
            'articles' => $repo->findAll()
        ]);

    }

    /**
     * @Route("/references_logements_participatifs", name="logements_participatifs")
     */
    public function logementsParticipatifs(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->getCategorie('Logement participatif');
        //dd($articles);

        return $this->render('content/logements_participatifs.html.twig',
        [
            'articles' => $articles,
        ]);
    }

    

}
