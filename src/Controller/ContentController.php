<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleMultiRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * Page d'Accueil
     */
    public function index(ArticleRepository $articleRepo)
    {
        return $this->render('content/index.html.twig',
        [
            'article1' => $articleRepo->findBy([ 'titre' => 'Faire la ville avec tous' ]),
            'article2' => $articleRepo->findBy([ 'titre' => 'Fabrique urbaine collaborative' ]),
            'article3' => $articleRepo->findBy([ 'titre' => 'Habitat participatif' ]),
            
        ]);
    }

    /**
     * @Route("/fabrique-urbaine-collaborative", name="fabrique_urbaine")
     */
    public function fabriqueUrbaineCollaborative(ArticleRepository $articleRepo) 
    {
        return $this->render('content/fabrique_urbaine.html.twig', 
        [
            'article' => $articleRepo->findBy([ 'titre' => 'Venez participer à la Fabrique urbaine collaborative !' ]),
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
     * @Route("/references-logements-participatifs", name="logements_participatifs")
     */
    public function logementsParticipatifs(ArticleRepository $articleRepo)
    {
        return $this->render('content/logements_participatifs.html.twig',
        [
            'articles' => $articleRepo->getCategorie('Logement participatif'),
        ]);
    }

    /**
     * @Route("/mentions-legales/{slug}", name="mentions_legales")
     */
    public function mentionsLegales($slug, ArticleRepository $articleRepo) 
    {
        return $this->render('content/mentions_legales.html.twig', [
            'mentionsLegales' => $articleRepo->findOneBySlug($slug),
        ]);
    }
    
    /**
     * Permet de créer le lien mentions légales dans la base
     * @Route("/mentions/link", name="mentions_link")
     *
     * @return void
     */
    public function linkMentionsLegales(ArticleRepository $articleRepo) 
    {
        return $this->render('content/mentions_legales_link.html.twig', [
            'mentionsLegales' => $articleRepo->findOneBy([ 'titre' => 'Mentions légales du site LesCityZens.fr' ]),
        ]);
    }

    /**
     * @Route("/conditions-generale-utilisation", name="conditions_utilisation")
     */
    public function conditionsUtilisation(EntityManagerInterface $manager) 
    {
        return $this->render('content/conditions_utilisation.html.twig', 
        [
            'conditions_utilisation' => $manager->getRepository(Article::class)->findOneBy([ 'titre' => 'Conditions d’utilisation du site LesCityZens.fr' ]),
        ]);
    }

    /**
     * @Route("/politique-confidentialite-et-protection-vie-privee", name="privacy_policy")
     */
    public function privacyPolicy(EntityManagerInterface $manager) 
    {
        return $this->render('content/privacy_policy.html.twig', 
        [
            'privacy_policy' => $manager->getRepository(Article::class)->findOneBy([ 'titre' => 'Politique de Confidentialité du site LesCityZens.fr' ]),
        ]);
    }

    /**
     * @Route("/cgu-privacy-policy-validation", name="cgu_validation")
     */
    public function cguValidation(SessionInterface $session) 
    {
        $cgu = $session->get('cgu_lcz', []);
        $cgu = 
        [
            'Condition générale d\'utilisation' => 'Acceptée',
            'Politique de confidentialité' => 'Acceptée',
        ];

        $session->set('cgu_lcz', $cgu);
        //dd($cgu);

        return new JsonResponse(
        [
            'success' => 'Request succeed !'
        ], 200);
    }

}
