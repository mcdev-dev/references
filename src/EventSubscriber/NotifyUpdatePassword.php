<?php

namespace App\EventSubscriber;

use App\Events;
use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Envoi un mail de bienvenue à chaque creation d'un utilisateur
 *
 */
class NotifyUpdatePassword implements EventSubscriberInterface
{
    private $mailer;
    private $sender;

    public function __construct(MailerInterface $mailer, $sender)
    {
        // On injecte notre expediteur et la classe pour envoyer des mails
        $this->mailer = $mailer;
        $this->sender = $sender;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // le nom de l'event et le nom de la fonction qui sera déclenché
            Events::USER_UPDATE_PASSWORD => 'onUserUpdatePassword',
        ];
    }

    public function onUserUpdatePassword(GenericEvent $event): void
    {
        /** @var User $user */
        $user = $event->getSubject();
        $subject = 'Modification du mot de passe';

        $email = (new TemplatedEmail())
            ->from('lcz.grabli@gmail.com')
            ->to('gedeon_muk@yahoo.fr')//$user->getEmail()
            ->subject($subject)

            // path of the Twig template to render
            ->htmlTemplate('security/signup_brindille.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => $user->getUsername(),
            ]);

        $this->mailer->send($email);
    }
    
}