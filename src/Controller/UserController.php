<?php

namespace App\Controller;

use App\Events;
use App\Entity\User;
use App\Form\UserType;
use App\Form\ProfileType;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/utilisateurs/liste", name="user_list")
     * @IsGranted("ROLE_ADMIN")
     * Route d'affichage de tous les utilisateurs dans la page Admin
     */
    public function index(UserRepository $repo)
    {
        return $this->render('user/index.html.twig', 
        [
            'users' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/user/add/", name="user_add")
     * Route permettant d'ajouter un utilisateur
     * @IsGranted("ROLE_ADMIN")
     */
    public function userAddAction(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) 
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

            $this->addFlash('success', 'L\'inscription de l\'utilisateur <strong>'. $user->getPrenom() .', </strong> a réussi avec succès.');
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/user_add.html.twig', 
        [
            'action' => 'Ajouter',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete")
     * Route permettant de supprimer un utilisateur
     * @IsGranted("ROLE_ADMIN")
     */
    public function userDeleteAction($id, ObjectManager $manager, UserRepository $repo) 
    {
        $user = $repo->find($id);
        if($user) 
        {
            $manager->remove($user);
            $manager->flush();
        }
        
        $this->addFlash('success', 'L\'utilisateur <strong>' . $user->getPrenom() . '</strong> a été supprimé avec succès.');
        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/user-name/", name="user_name")
     * Route pour afficher le nom de l'utilisateur
     */
    public function userNameAction() 
    {
        return $this->render('user/user_name.html.twig', 
        [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/user-profile/", name="user_profile")
     * Route du profile de l'utilisateur
     * @IsGranted("ROLE_USER")
     */
    public function userProfileAction(Request $request, ObjectManager $manager, EventDispatcherInterface $eventDispatcher) 
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        
        //dd($user);
        if($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($user);
            $manager->flush();

            //On déclenche l'eventDispatcher
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_UPDATE_PROFILE, $event);

            $this->addFlash('success', '<strong>' . $user->getPrenom() . '</strong>, votre profil a été mis à jour avec succès.' );
            return $this->redirectToRoute('user_profile');

        }

        return $this->render('user/user_profile.html.twig', 
        [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/reset-password/", name="reset_password")
     * Route de modification du mot de passe
     * @IsGranted("ROLE_USER")
     */
    public function resetPasswordAction(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $eventDispatcher) 
    {
        $user = $this->getUser();
        $form = $this->createForm(ResetPasswordType::class, $user);
        $form->handleRequest($request);
        
        //dd($request->get('soumission'));
        if($form->isSubmitted() && $form->isValid()) 
        {
            $oldPassword = $request->request->get('reset_password')['oldPassword'];
            //dd($oldPassword);
            // Si l'ancien mot de passe est bon
            if ($encoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newEncodedPassword);
                
                $manager->persist($user);
                $manager->flush();

                //On déclenche l'eventDispatcher
                $event = new GenericEvent($user);
                $eventDispatcher->dispatch(Events::USER_UPDATE_PASSWORD, $event);

                $this->addFlash('success', '<strong>'. $user->getPrenom(). '</strong>, votre mot de passe à bien été changé !');

                return $this->redirectToRoute('user_profile');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }

        return $this->render('user/reset_password.html.twig', 
        [
            'user' => $user,
            'ResetPasswordForm' => $form->createView(),
        ]);

    }
    

}
