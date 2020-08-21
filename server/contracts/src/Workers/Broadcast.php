<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Broadcast
{
    public function getMessage(): ?WorkerMessageRequest;

    public function setMessage(WorkerMessageRequest $message): self;

    public function isCompleted(): bool;

    public function setCompleted(): self;

    public function registerFailedBroadcast(Worker $worker): self;

    public function failedWorkers(): array;
}