<?php


namespace App\DashBoard\Subscriber;

use Evrinoma\DashBoardBundle\Event\InfoEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InfoSubscriber implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            InfoEvent::class => 'onInfoEvent',
        ];
    }

    public function onInfoEvent(InfoEvent $event)
    {
        $event->addInfo(['titleHeader' => 'Administration', 'pageName' => 'System Status']);
    }
}