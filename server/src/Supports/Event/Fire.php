<?php


namespace ADelf\LeaderServer\Supports\Event;


use ADelf\LeaderServer\Contracts\Event\EventFire;

abstract class Fire implements EventFire, \JsonSerializable
{
    protected $data;
    protected $listeners = [];
    protected $identifier;

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
        return $this->identifier;
    }

    public function jsonSerialize()
    {
        return json_encode([
            'data' => $this->data,
            'listeners' => $this->listeners,
            'identifier' => $this->identifier,
        ]);
    }
}