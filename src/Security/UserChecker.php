<?php

namespace App\Security;

use App\Exception\AccountDeletedException;
use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        /*if ($user->isDeleted()) {
            throw new AccountDeletedException();
        }*/

        if(true !== $user->getEnabled()) 
        {
            throw new \RuntimeException('Un email de confirmation vous a été envoyé. Veuillez confirmer votre inscription avant de pouvoir vous connecter.');
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

        $this->checkPreAuth($user);
    }
}
