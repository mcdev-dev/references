<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublishController extends AbstractController
{
    /**
     * @Route("/message/{user}", name="send_message", methods={"POST"})
     */
    public function message(MessageBusInterface $bus, ?User $user = null, SerializerInterface $serializer): Response
    {
        $userTarget = array();

        if(null !== $userTarget)
        {
            $userTarget = [ "http://lescityzens.net/user/{$user->getId()}" ];
        }

        $update = new Update(
            'http://lescityzens.net/chat',
            $serializer->serialize($this->getUser(), 'json', [ 'groups' => 'public' ]),
            $userTarget // Here are the targets
        );

        $bus->dispatch($update);

        return $this->redirectToRoute('chat');
    }
}