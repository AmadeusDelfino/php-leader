<?php


namespace ADelf\LeaderServer\WorkerNotify;


use ADelf\LeaderServer\Contracts\Workers\Broadcast as IBroadcast;
use ADelf\LeaderServer\Contracts\Workers\WorkerMessageRequest;
use ADelf\LeaderServer\Contracts\Workers\Worker;

class Broadcast implements IBroadcast
{
    protected $message;
    protected $completed = false;
    protected $fails = [];

    public function __construct(WorkerMessageRequest $message = null)
    {
        $this->message = $message;
    }

    public function getMessage(): ?WorkerMessageRequest
    {
        return $this->message;
    }

    public function setMessage(WorkerMessageRequest $message): IBroadcast
    {
        $this->message = $message;

        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(): IBroadcast
    {
        $this->completed = true;

        return $this;
    }

    public function registerFailedBroadcast(Worker $worker): IBroadcast
    {
        $this->fails[] = $worker;

        return $this;
    }

    public function failedWorkers(): array
    {
        return $this->fails;
    }
}