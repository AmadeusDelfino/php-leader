<?php


namespace ADelf\LeaderServer\Events;


use ADelf\LeaderServer\EventListeners\WorkerHaltListener;
use ADelf\LeaderServer\Supports\Event\Fire;

class WorkerHaltEvent extends Fire
{
    protected $listeners = [
        WorkerHaltListener::class,
    ];
    protected $identificer = 'worker_halt';
}