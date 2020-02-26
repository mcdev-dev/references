<?php

namespace App\EventSubscriber;

use App\Events;
use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * Envoi un mail de bienvenue à chaque creation d'un utilisateur
 *
 */
class RegistrationNotifySubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $sender;
    private $tokenGenerator;

    public function __construct(MailerInterface $mailer, $sender, TokenGeneratorInterface $tokenGenerator)
    {
        // On injecte notre expediteur et la classe pour envoyer des mails
        $this->mailer = $mailer;
        $this->sender = $sender;
        $this->tokenGenerator = $tokenGenerator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // le nom de l'event et le nom de la fonction qui sera déclenché
            Events::USER_REGISTERED => 'onUserRegistrated',
        ];
    }

    public function onUserRegistrated(GenericEvent $event): void
    {
        /** @var User $user */
        $user = $event->getSubject();

        //On crée le token
        $user->setConfirmationToken($this->tokenGenerator->generateToken());

        $subject = 'Mail de confirmation';

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
                'username' => $user->getUsername(),
                'token' => $user->getConfirmationToken(),
            ]);

        $this->mailer->send($email);

        /*$subject = 'Merci pour l\'enregistrement !';

        $email = (new TemplatedEmail())
            ->from('lcz.grabli@gmail.com')
            ->to('gedeon_muk@yahoo.fr')//$user->getEmail()
            ->subject($subject)

            // path of the Twig template to render
            ->htmlTemplate('security/signup_brindille.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'user' => $user,
            ]);

        $this->mailer->send($email);*/
    }
    
}