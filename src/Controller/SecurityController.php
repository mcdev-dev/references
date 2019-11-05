<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * Page d'inscription
     */
    public function registration(ObjectManager $manager, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            if(!empty($user->getAbonneNewsletter())) 
            {
                $user->setAbonneNewsletter('OUI');
            } else {
                $user->setAbonneNewsletter('NON');
            }
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', $user->getPrenom() . ', votre inscription a réussie avec succès, veuillez vous connecter.');
            return $this->redirectToRoute('connexion');
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
    public function connexion(AuthenticationUtils $auth) 
    {
        $lastUsername = $auth->getLastUsername();
        $authenticationError = $auth->getLastAuthenticationError();

        if(!empty($authenticationError)) 
        {
            $this->addFlash('errors', '<strong>Désolé !</strong> Erreur sur les identifiants.');
        } 
        if($lastUsername) {
            $this->addFlash('success', '<strong>Bienvenue sur notre site !</strong> Les CityZens est heureux de vous accueillir.');
        }

        return $this->render('security/connexion.html.twig', 
        [
            'lastUsername' => $lastUsername
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

}
