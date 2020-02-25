<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LostPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/reset/get-email", name="get_email")
     * @return Response
     */
    public function getEmail() 
    {
        return $this->render('security/get_email.html.twig', []);
    }

    /**
     * @Route("/reset/lost-password/redirect", name="lost_password_redirect")
     */
    public function lostPasswordRedirect(Request $request, EntityManagerInterface $manager) 
    {
        //1 - Vérifier que l'email envoyé est enregistré en BDD
        $mail_send = $manager->getRepository(User::class)->findOneBy(['email' => $request->get('email')]);
        //dd(count($mail_send)); die;
        if(!$mail_send) 
        {
            $this->addFlash('errors', '<strong>Désolé !</strong> Il n’existe pas de compte avec cette adresse de messagerie.');
            return $this->render('security/login_lost_password.html.twig', []);
        } 
        else 
        {
            //2 test - Redirection vers la page de modification du mot de passe
            return $this->redirectToRoute('reset_lost_password');
            //2 - Envoi par mail du lien de la Route pour la modification du mot de passe
        }

    }

    /**
     * @Route("/reset/lost-password", name="reset_lost_password")
     */
    public function resetLostPassword(Request $request, SessionInterface $session, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager) 
    {
        $form = $this->createForm(LostPasswordType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) 
        {
            $user = $manager->getRepository(User::class)->findOneBy(['email' => $request->get('email_lost')]);
            
            $user->setPassword($encoder->encodePassword($user, $form->get('plainPassword')['first']->getData()));
            $manager->persist($user);
            $manager->flush();

            $session->get('reset_confirm', []);
            $tokenConfirm = uniqid();
            $session->set('reset_confirm', $tokenConfirm);

            $this->addFlash('success', '<strong>'. $user->getPrenom(). '</strong>, votre mot de passe à bien été changé !');

            return $this->redirectToRoute('connexion');
            
        }

        return $this->render('security/reset_lost_password.html.twig', 
        [
            'form' => $form->createView(),
        ]);
    }
}
