<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * Page d'inscription
     */
    public function registration(ObjectManager $manager, Request $request)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        //if() 
        {

        }
        
        return $this->render('security/inscription.html.twig', 
        [
            'registrationForm' => $form->createView()
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
