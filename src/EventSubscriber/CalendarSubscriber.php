<?php


namespace App\EventSubscriber;


use App\Repository\CalendrierRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Event\CalendarEvent;
use CalendarBundle\Entity\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{

    private $calendrierRepository;
    private $router;

    public function __construct(CalendrierRepository $calendrierRepository, UrlGeneratorInterface $router)
    {
        $this->calendrierRepository = $calendrierRepository;
        $this->router = $router;
    }
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData'
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendrierEvent)
    {
        $start = $calendrierEvent->getStart();
        $end = $calendrierEvent->getEnd();
        $filter = $calendrierEvent->getFilters();

        $bookings = $this->calendrierRepository
            ->createQueryBuilder('calendrier')
            ->where('calendrier.beginAt BETWEEN :start and :end OR calendrier.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        foreach ($bookings as $booking) {
            $bookingEvent = new Event(
                $booking->getTitle(),
                $booking->getDescription(),
                $booking->getBeginAt(),
                $booking->getEndAt()
            );

            $bookingEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'blue'
            ]);

            $bookingEvent->addOption(
                'url',
                $this->router->generate('calendrier_show',
                    [
                        'id' => $booking->getId(),
                    ])
            );
            $calendrierEvent->addEvent($booking);

        }

    }
}