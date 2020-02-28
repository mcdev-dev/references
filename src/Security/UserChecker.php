<?php

namespace App\Security;

use Exception;
use App\Entity\User as AppUser;
use App\Exception\AccountDeletedException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;

class UserChecker implements UserCheckerInterface
{

    private $flash;
    private $router;

    public function __construct(FlashBagInterface $flash, UrlGeneratorInterface $router) 
    {
        $this->flash = $flash;
        $this->router = $router;
    }

    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        /*if ($user->isDeleted()) {
            throw new AccountDeletedException();
        }
        
        if(true !== $user->getEnabled()) 
        {
            $this->flash->add('errors', 'Un email de confirmation vous a été envoyé. Veuillez confirmer votre inscription avant de pouvoir vous connecter.');

            return $this->router->generate('connexion', [], 302);
        }*/

        if(true !== $user->getEnabled()) 
        {
            throw new Exception("Un email de confirmation vous a été envoyé. Veuillez confirmer votre inscription avant de pouvoir vous connecter.", 1);
            
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        /*if ($user->isExpired()) {
            throw new AccountExpiredException('...');
        }*/

        //$this->checkPreAuth($user);
    }
}
