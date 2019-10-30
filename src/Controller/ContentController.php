<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * Page d'Accueil
     */
    public function index()
    {
        return $this->render('content/index.html.twig',
        [
            
        ]);
    }
}
