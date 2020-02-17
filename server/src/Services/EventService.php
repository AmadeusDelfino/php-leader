<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Event\EventFire;
use ADelf\LeaderServer\Contracts\Event\EventListener;

class EventService
{
    public function fire(EventFire $eventFire)
    {
        foreach ($eventFire->getListeners() as $listener) {
            /**
             * @var $listener EventListener
             */
            (new $listener)->handler($eventFire);
        }
    }
}