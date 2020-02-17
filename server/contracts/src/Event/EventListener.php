<?php


namespace ADelf\LeaderServer\Contracts\Event;


interface EventListener
{
    public function handler(EventFire $eventFire): void;
}