<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidaturesController extends AbstractController
{
    /**
     * @Route("/candidatures", name="candidatures")
     */
    public function index()
    {
        return $this->render('candidatures/index.html.twig', [
            'controller_name' => 'CandidaturesController',
        ]);
    }

    /**
     * @Route("/candidature/projet/", name="questionnaire_candidature")
     * @IsGranted("ROLE_USER")
     */
    public function candidatureAction(Request $request) 
    {

        return $this->render('candidatures/questionnaire_candidature.html.twig', 
        [
            'projectName' => 'Ivry',
            //'form' => $form,
        ]);
    }

}
