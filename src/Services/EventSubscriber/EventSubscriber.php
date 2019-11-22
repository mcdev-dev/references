<?php

namespace App\Services\EventSubscriber;

use App\Repository\EventRepository;
use App\Entity\Event as AppEvent;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event as CalendarBundleEvent;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EventSubscriber implements EventSubscriberInterface
{
    private $eventRepository;
    private $router;

    public function __construct(EventRepository $eventRepository, UrlGeneratorInterface $router)
    {
        $this->eventRepository = $eventRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $events = $this->eventRepository->findByDateTime($start, $end);
            
        foreach ($events as $event) {
            // this create the events with your data to fill calendar
            $CalendarBundleEvent = new CalendarBundleEvent(
                $event->getTitre(),
                $event->getBeginAt(),
                $event->getEndAt(), // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $CalendarBundleEvent->setOptions([
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'className'=> 'text-white',
                'description' => $event->getDescription(),
                'location' => $event->getLieu(),
                'telephone' => $event->getTelephone(),
                'id' => $event->getId(),
            ]);
            $CalendarBundleEvent->addOption(
                'url',
                $this->router->generate('event_show', [
                    'id' => $event->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            // FIXME: Filtrer les events selon le projet des users.
            $calendar->addEvent($CalendarBundleEvent);
        }
    }
}