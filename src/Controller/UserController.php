<?php

namespace App\Controller;

use App\Events;
use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Form\AvatarType;
use App\Form\ProfileType;
use App\Services\UploadAvatar;
use App\Entity\UserCoordonnees;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/utilisateurs/liste", name="user_list")
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
     * @Route("/admin/user/add/", name="user_add")
     * Route permettant d'ajouter un utilisateur
     */
    public function userAdd(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) 
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

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

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
     * @Route("/admin/user/delete/{id}", name="user_delete")
     * Route permettant de supprimer un utilisateur
     */
    public function userDeleteAction($id, EntityManagerInterface $manager) 
    {
        $user = $manager->getRepository(User::class)->find($id);
        if(null !== $user) 
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
     * @Route("/user/profile/", name="user_profile")
     * Route du profile de l'utilisateur
     */
    public function userProfile(Request $request, EntityManagerInterface $manager, EventDispatcherInterface $eventDispatcher) 
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
     * @param Request $request
     * @return JsonResponse
     * @Route("/profile/avatar", name="image", methods={"POST"}, options={"expose"=true})
     */
    public function getAvatar(Request $request, UploadAvatar $uploadService, EntityManagerInterface $manager) 
    {
        if($request->isXmlHttpRequest()) 
        {
            $user = $this->getUser();
            $avatar = $user->getUserCoordonnees()->getAvatar();
            
            $file = new UploadedFile($_FILES['file']['tmp_name'], $_FILES['file']['name'], $_FILES['file']['type'], $_FILES['file']['error']);

            if(null !== $avatar) 
            {
                $uploadService->removeFile($avatar);

                if($file) 
                {
                    $file_name = $uploadService->uploadFile($file);
                    // Persist to Database
                    $user->getUserCoordonnees()->setAvatar($file_name);
                    $manager->flush();
                }
            }

            return new JsonResponse($file_name);
        }
        
    }

    /**
     * @Route("/user/reset-password/", name="reset_password")
     * Route de modification du mot de passe
     */
    public function resetPasswordAction(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $eventDispatcher) 
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
                //$event = new GenericEvent($user);
                //$eventDispatcher->dispatch(Events::USER_UPDATE_PASSWORD, $event);

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
