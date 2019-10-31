<?php

namespace App\Controller;

use App\Entity\ContactEmail;
use App\Form\ContactEmailType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactEmailController extends AbstractController
{
    /**
     * @Route("/contact/email", name="contact_email")
     */
    public function contactEmail()
    {
        $email = new ContactEmail();
        
        $form = $this->createForm(ContactEmailType::class, $email);

        return $this->render('contact_email/index.html.twig', [
            'title' => 'Page de contact',
            'form' => $form->createView(),
        ]);
    }
}
