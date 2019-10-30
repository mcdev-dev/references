<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * Page d'inscription
     */
    public function inscription()
    {
        return $this->render('security/inscription.html.twig', 
        [
            
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     * Page de connexion
     */
    public function connexion() 
    {
        return $this->render('security/connexion.html.twig', 
        [

        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

}
