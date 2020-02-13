<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Broadcast
{
    public function getMessage(): NotifyMessage;

    public function setMessage(): self;

    public function isCompleted(): bool;

    public function setCompleted(): self;

    public function registerFailedBroadcast(Worker $worker): self;
}