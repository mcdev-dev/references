<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\EventValidator\EventValidator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/calendar", name="event_calendar", methods={"GET"})
     */
    public function calendar(): Response
    {
        return $this->render('event/calendar.html.twig', [ 'title' => 'Calendrier' ]);
    }

    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'title' => 'Index event'
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_calendar');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'title' => 'Créer un nouvel évènement',
        ]);
    }

    /**
     * @Route("/new_from_calendar", name="event_new_from_calendar", methods={"POST"})
     */
    public function new_from_calendar(Request $request, EventValidator $validator, EntityManagerInterface $manager)
    {
        $data = $request->getContent();
        
        if (empty($data))
            throw new \Exception("Données d'évènement vide");

        $event = $validator->validateAndCreate($data, Event::class);
        
        $manager->persist($event);
        $manager->flush();
        
        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'title' => $event->getTitre(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_calendar');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'title' => 'Edition'
        ]);
    }
    /**
     * @Route("/{id}/edit_from_calendar", name="event_edit_from_calendar", methods={"POST"})
     */
    public function edit_from_calendar(Request $request, Event $event, EventValidator $validator, EntityManagerInterface $manager)
    {
        // Get data from Ajax edit request from calendar.html.twig 
        $data = $request->getContent();
        if (empty($data))
            throw new \Exception("Données d'évènement vide");
        
        // Validate and update event
        $validator->validateAndUpdate($data, $event);
        $manager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_calendar');
    }
}
