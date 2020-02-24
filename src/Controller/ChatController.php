<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Mercure\Update;
use App\Mercure\MercureCookieGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function chat(MercureCookieGenerator $cookieGenerator)
    {
        
        $response = $this->render('chat/index.html.twig', 
        [
            'user' => $this->getUser(),
        ]);
        $response->headers->set('set-cookie', $cookieGenerator->generate($this->getUser()));

        //$response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        //$response->headers->set('Access-Control-Allow-Origin', '*');
        //$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        //$response->headers->set('Content-Type', 'text/html');

        return $response;
    }

}
