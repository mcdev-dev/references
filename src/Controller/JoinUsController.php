<?php

namespace App\Controller;

use App\Entity\JoinUs;
use App\Form\JoinUsType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JoinUsController extends AbstractController
{
    /**
     * @Route("/join/us", name="join_us")
     */
    public function index()
    {
        return $this->render('join_us/index.html.twig', [
            'controller_name' => 'JoinUsController',
        ]);
    }

    /**
     * @Route("/rejoignez-nous/", name="nous_rejoindre")
     * Route de la page Rejoignez-nous
     */
    public function rejoignezNousAction(Request $request, ObjectManager $manager) 
    {
        $candidat = new JoinUs;
        $form = $this->createForm(JoinUsType::class, $candidat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($candidat);
            $manager->flush();

            $this->addFlash('success', $candidat->getPrenom() . ', merci de nous avoir rejoint.');
            return $this->redirectToRoute('home');
        }

        return $this->render('join_us/nous_rejoindre.html.twig', 
        [
            'form' => $form->createView(),
        ]);
    }

}
