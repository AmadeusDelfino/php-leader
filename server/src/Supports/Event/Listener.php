<?php


namespace ADelf\LeaderServer\Supports\Event;


use ADelf\LeaderServer\Contracts\Event\EventFire;
use ADelf\LeaderServer\Contracts\Event\EventListener;

abstract class Listener implements EventListener
{
    abstract public function handler(EventFire $eventFire): void;
}