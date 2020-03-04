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
class NotifyPostCandidature implements EventSubscriberInterface
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
            Events::USER_NOTIFY_POST_CANDIDATURE => 'onUserNotifyPostCandidature',
        ];
    }

    public function onUserNotifyPostCandidature(GenericEvent $event): void
    {
        /** @var User $user */
        $user = $event->getSubject();
        $subject = 'Nouvelle candidature transmise';

        $email = (new TemplatedEmail())
            ->from('noreply@lescityzens.fr')
            ->to('saintferjeux@lescityzens.fr')
            ->subject($subject)

            // path of the Twig template to render
            ->htmlTemplate('candidatures/user_notify_post_candidature.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'user' => $user,
            ]);

        $this->mailer->send($email);
    }
    
}