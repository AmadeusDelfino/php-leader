<?php


namespace ADelf\LeaderServer\Supports\Event;


use ADelf\LeaderServer\Contracts\Event\EventFire;

abstract class Fire implements EventFire
{
    protected $data;
    protected $listeners = [];
    protected $identificer;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getListeners(): array
    {
        return $this->listeners;
    }

    public function getIdentifier(): string
    {
        return $this->identificer;
    }
}