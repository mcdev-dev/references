<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
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
