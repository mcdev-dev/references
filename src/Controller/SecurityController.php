<?php

namespace App\Controller;

use App\Events;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     * Page d'inscription
     */
    public function registration(ObjectManager $manager, Request $request, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $eventDispatcher)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setLastLogin(new \DateTime);
            $user->setregistrationDate(new \DateTime);

            if($user->getAbonneNewsletter() == true) 
            {
                $user->setAbonneNewsletter(1);
            } else {
                $user->setAbonneNewsletter(0);
            }
            $manager->persist($user);
            $manager->flush();

            //On déclenche l'eventDispatcher
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);

            $this->addFlash('success', '<strong>' . $user->getPrenom() . '</strong>, Votre inscription a été validée, vous aller recevoir un email de confirmation pour activer votre compte et pouvoir vous connecté.');
            return $this->redirectToRoute('connexion');
        }
        
        return $this->render('security/inscription.html.twig', 
        [
            'registrationForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/confirm/{token}/{username}", name="confirm_account")
     * @param $token
     * @param $username
     * @return Response
     */
    public function confirmAccount($token, $username, ObjectManager $manager, UserRepository $repo): Response
    {
        $user = $repo->findOneBy(['username' => $username]);
        $tokenExist = $user->getConfirmationToken();
        if($token === $tokenExist) {
           $user->setConfirmationToken(null);
           $user->setEnabled(true);
           $manager->persist($user);
           $manager->flush();
           return $this->redirectToRoute('connexion');
        } else {
            return $this->render('security/token-expire.html.twig');
        }
    }

    /**
     * @Route("/send-token-confirmation", name="send_confirmation_token")
     * @param Request $request
     * @param MailerService $mailerService
     * @param \MailerInterface $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    /*public function sendConfirmationToken(Request $request, MailerService $mailerService, MailerInterface $mailer, ObjectManager $manager): RedirectResponse
    {
        $email = $request->request->get('email');
        $user = $repo->findOneBy(['email' => $email]);
        if($user === null) {
            $this->addFlash('errors', 'utilisateur non trouvé');
            return $this->redirectToRoute('inscription');
        }
        $user->setConfirmationToken($mailerService->generateToken());
        $manager->persist($user);
        $manager->flush();
        $token = $user->getConfirmationToken();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $mailerService->sendToken($mailer, $token, $email, $username, 'inscription.html.twig');
        return $this->redirectToRoute('connexion');
    }*/

    /**
     * @Route("/connexion", name="connexion")
     * Page de connexion
     */
    public function connexion(AuthenticationUtils $auth) 
    {
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();

        if(!empty($error)) 
        {
            $this->addFlash('errors', '<strong>Désolé !</strong> Erreur sur les identifiants.');
        } 
        /*if($this->getUser()) {
            $this->addFlash('success', '<strong>Bienvenue sur notre site !</strong> Les CityZens est heureux de vous accueillir.');
        }*/

        return $this->render('security/connexion.html.twig', [
            'last_username' => $lastUsername,
            //'error'         => $error,
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

}
    
    /**
     * @Route("/mot-de-passe-oublier", name="forgotten_password")
     * @param Request $request
     * @param MailerService $mailerService
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Exception
     */
    /*public function forgottenPassword(Request $request, MailerService $mailerService, \Swift_Mailer $mailer): Response
    {
        if($request->isMethod('POST')) {
            $email = $request->get('email');
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
            if($user === null) {
                $this->addFlash('user-error', 'utilisateur non trouvé');
                return $this->redirectToRoute('app_register');
            }
            $user->setTokenPassword($mailerService->generateToken());
            $user->setCreatedTokenPasswordAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $token = $user->getTokenPassword();
            $email = $user->getEmail();
            $username = $user->getUsername();
            $mailerService->sendToken($mailer, $token, $email, $username, 'forgotten_password.html.twig');
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/forgotten_password.html.twig');
    }
    /**
     * @Route("/reset-password/{token}", name="reset_password")
     * @param Request $request
     * @param $token
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    /*public function resetPassword(Request $request, $token, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $em->getRepository(User::class)->findOneBy(['tokenPassword' => $token]);
            if($user === null) {
                $this->addFlash('not-user-exist', 'utilisateur non trouvé');
                return $this->redirectToRoute('app_register');
            }
            $user->setTokenPassword(null);
            $user->setCreatedTokenPasswordAt(null);
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $em->flush();
            return $this->redirectToRoute('connexion');
        }
        return $this->render('registration/reset-password.html.twig', [
            'form' => $form->createView()
        ]);
    }*/