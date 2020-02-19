<?php


namespace ADelf\LeaderServer\Contracts\Event;


interface EventController
{
    public function events(): array;

    public function addEvent(EventFire $eventFire): self;

    public function getAndRemoveEvent(): EventFire;

    public function flush(): void;
}