<?php

namespace App\Controller;

use App\Entity\ContactEmail;
use App\Form\ContactEmailType;
use Symfony\Component\Mime\Email;
use App\Repository\ContactEmailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactEmailController extends AbstractController
{
    /**
     * @Route("/contact/email", name="contact_email")
     */
    public function contactEmail(Request $request, MailerInterface $mailer, ObjectManager $manager)
    {
        $email = new ContactEmail;
        $form = $this->createForm(ContactEmailType::class, $email);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            
            $email = (new Email())
                ->to("rnguyen@lescityzens.fr")
                ->from($email->getFromEmail())
                // ->replyTo("rnguyen@lescityzens.fr")
                ->subject($email->getSubject())
                ->text($email->getContent());

            $mailer->send($email);

            $manager->persist($email);
            $manager->flush();

            $this->addFlash('success', 'Votre email a été envoyé avec succès.');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact_email/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}


