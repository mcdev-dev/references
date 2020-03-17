<?php

namespace App\Controller;

use App\Events;
use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Entity\UserCoordonnees;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * Page d'inscription
     */
    public function registration(EntityManagerInterface $manager, Request $request, UserPasswordEncoderInterface $encoder, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer)
    {
        $user = new User;
        $userRole = new Role;
        $adresse = new UserCoordonnees;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $userRole->setTitle('ROLE_USER');
            $user->addUserRole($userRole);

            $adresse->setAvatar('default_avatar');
            $user->setUserCoordonnees($adresse);
            $user->setEnabled(true);

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $user->setLastLogin(new \DateTime);
            $user->setregistrationDate(new \DateTime);
            $user->setSlug($user->getPrenom() .' '. $user->getNom());

            $token = $tokenGenerator->generateToken();
            $user->setConfirmationToken($token);

            $manager->persist($userRole);
            $manager->persist($adresse);
            $manager->persist($user);
            $manager->flush();

/*            $url = $this->generateUrl('confirm_account', [ 'token' => $token ], UrlGeneratorInterface::ABSOLUTE_URL);
            //dd($url); die;
            if(null !== $user->getConfirmationToken()) 
            {
                //On envoi l'email
                $subject = 'Confirmation de l\'inscription';

                $email = (new TemplatedEmail())
                ->from('noreply@lescityzens.fr')
                ->to($user->getEmail())//$user->getEmail()
                ->subject($subject)

                // path of the Twig template to render
                ->htmlTemplate('security/signup_brindille.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'user' => $user,
                    'url' => $url,
                    'token' => $token,
                ]);

                $mailer->send($email);
            }*/

            $this->addFlash('success', '<strong>' . $user->getPrenom() . '</strong>, votre inscription a été validée.<!--, vous allez recevoir un email de confirmation pour activer votre compte et pouvoir vous connecter.-->');
            return $this->redirectToRoute('connexion');
        }
        
        return $this->render('security/inscription.html.twig', 
        [
            'registrationForm' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/account/confirm/{token}", name="confirm_account")
     * @param $token
     * @return Response
     */
    public function confirmAccount($token = null, EntityManagerInterface $manager): Response
    {
        $user = $manager->getRepository(User::class)->findOneByConfirmationToken($token);
        $tokenExist = $user->getConfirmationToken();
        if($token === $tokenExist) 
        {
           $user->setConfirmationToken(null);
           $user->setEnabled(true);

           $manager->persist($user);
           $manager->flush();
            
           $this->addFlash('success', '<strong>'. $user->getPrenom() .',</strong> votre compte vient d\'être activé avec succès. Veuillez vous connecter.');
           return $this->redirectToRoute('connexion');
        } 
        /*else {
            return $this->render('security/token-expire.html.twig');
        }*/
    }

    /**
     * @Route("/connexion", name="connexion")
     * Page de connexion
     */
    public function connexion(AuthenticationUtils $auth, SessionInterface $session, Request $request) 
    {
        return $this->render('security/connexion.html.twig', 
        [
            'username' => $auth->getLastUsername(),
            'hasError' => $auth->getLastAuthenticationError() !== null,
            'resetConfirm' => $session->get('reset_confirm')
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

}