<?php


namespace ADelf\LeaderServer\Contracts\Event;


interface EventFire
{
    public function __construct($data);

    public function getData();

    public function getIdentifier(): string;

    public function getListeners(): array;
}