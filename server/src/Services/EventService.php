<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Event\EventFire;

class EventService
{
    public function fire(EventFire $eventFire)
    {
        eventController()->addEvent($eventFire);
    }

    public function execute(EventFire $eventFire)
    {
        foreach($eventFire->getListeners() as $listener) {
            (new $listener())->handler($eventFire);
        }
    }
}