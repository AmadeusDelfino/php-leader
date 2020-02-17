<?php


namespace ADelf\LeaderServer\EventListeners;


use ADelf\LeaderServer\Contracts\Event\EventFire;
use ADelf\LeaderServer\Supports\Event\Listener;

class WorkerHaltListener extends Listener
{
    public function handler(EventFire $eventFire): void
    {
        echo $eventFire->getIdentifier();
    }
}