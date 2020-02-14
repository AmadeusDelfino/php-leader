<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Broadcast
{
    public function getMessage(): ?NotifyMessage;

    public function setMessage(NotifyMessage $message): self;

    public function isCompleted(): bool;

    public function setCompleted(): self;

    public function registerFailedBroadcast(Worker $worker): self;

    public function failedWorkers(): array;
}