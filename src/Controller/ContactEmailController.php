<?php

namespace App\Controller;

use App\Entity\ContactEmail;
use App\Form\ContactEmailType;
use Symfony\Component\Mime\Email;
use App\Repository\ContactEmailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactEmailController extends AbstractController
{
    /**
     * @Route("/contact/email", name="contact_email")
     */
    public function contactEmail(Request $request, MailerInterface $mailer)
    {
        $emailInfo = new ContactEmail();
        $form = $this->createForm(ContactEmailType::class, $emailInfo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            
            $email = (new Email())
                ->to("rnguyen@lescityzens.fr")
                ->from($emailInfo->getFromEmail())
                // ->replyTo("rnguyen@lescityzens.fr")
                ->subject($emailInfo->getSubject())

                ->text($emailInfo->getContent());


            $mailer->send($email);

            $entityManager->persist($emailInfo);
            $entityManager->flush();

            return $this->render('contact_email/confirm.html.twig', [
                'title' => 'Page de contact',
                'message' => 'Votre email a bien été envoyé.'
            ]);
        }

        return $this->render('contact_email/index.html.twig', [
            'title' => 'Page de contact',
            'form' => $form->createView(),
        ]);
    }
}


