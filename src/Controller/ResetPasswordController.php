<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LostPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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
    public function lostPasswordRedirect(Request $request, EntityManagerInterface $manager, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator) 
    {
        //1 - Vérifier que l'email envoyé est enregistré en BDD
        $user = $manager->getRepository(User::class)->findOneBy(['email' => $request->get('email')]);
        //dd(count($mail_send)); die;
        if(!$user) 
        {
            $this->addFlash('errors', '<strong>Désolé !</strong> Il n’existe pas de compte avec cette adresse de messagerie.');
            return $this->render('security/login_lost_password.html.twig', []);
        } 
        else 
        {
            //2 test - Redirection vers la page de modification du mot de passe
            //return $this->redirectToRoute('reset_lost_password');

            //2 - Envoi par mail du lien de la Route pour la modification du mot de passe
            // 2.1 - création du token
            $token = $tokenGenerator->generateToken();
            // dd($token);
            $user->setConfirmationToken($token);
            $manager->persist($user);
            $manager->flush();

            $url = $this->generateUrl('reset_lost_password', [ 'token' => $token ], UrlGeneratorInterface::ABSOLUTE_URL);
            //dd($url); die;
            if(null !== $user->getConfirmationToken())
            {
                //On envoi l'email
                $subject = 'Modification du mot de passe oublié';

                $email = (new TemplatedEmail())
                ->from('noreply@lescityzens.fr')
                ->to($user->getEmail())//$user->getEmail()
                ->subject($subject)

                // path of the Twig template to render
                ->htmlTemplate('security/lost_email_brindille.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'user' => $user,
                    'url' => $url,
                    'token' => $token,
                ]);

                $mailer->send($email);

                $this->addFlash('success', '<strong>'. $user->getPrenom(). '</strong>, un mail vous a été envoyé !');
    
                return $this->redirectToRoute('connexion');
            }
            
        }

    }

    /**
     * @Route("/reset/lost-password/{token}", name="reset_lost_password")
     */
    public function resetLostPassword(string $token = null, Request $request, SessionInterface $session, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager) 
    {
        // vérifier que le token fourni correspond bien à l'email donné
        $user = $manager->getRepository(User::class)->findOneByConfirmationToken($token);
        dd($user); die;
        if(null !== $user) $user->setConfirmationToken(null);
        // proposer un formulaire pour saisir le nouveau mot de passe
        $form = $this->createForm(LostPasswordType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) 
        {
            $user->setPassword($encoder->encodePassword($user, $form->get('plainPassword')['first']->getData()));
            $manager->persist($user);
            $manager->flush();

            $session->get('reset_confirm', []);
            $tokenConfirm = uniqid();
            $session->set('reset_confirm', $tokenConfirm);

            $this->addFlash('success', '<strong>'. $user->getPrenom() .'</strong>, votre mot de passe à bien été changé !');

            return $this->redirectToRoute('connexion');
            
        }

        return $this->render('security/reset_lost_password.html.twig', 
        [
            'form' => $form->createView(),
        ]);
    }
}
