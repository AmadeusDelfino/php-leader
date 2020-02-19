<?php


namespace ADelf\LeaderServer\EventsFoundation;


use ADelf\LeaderServer\Contracts\Event\EventFire;

class EventController implements \ADelf\LeaderServer\Contracts\Event\EventController
{
    protected $events = [];

    public function events(): array
    {
        return $this->events;
    }

    public function addEvent(EventFire $eventFire): \ADelf\LeaderServer\Contracts\Event\EventController
    {
        $this->events[] = $eventFire;

        return $this;
    }

    public function getAndRemoveEvent(): EventFire
    {
        return array_shift($this->events);
    }

    public function flush(): void
    {
        $this->events = [];
    }
}