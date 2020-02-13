<?php


namespace ADelf\LeaderServer\WorkerNotify;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\Worker;

class Broadcast implements \ADelf\LeaderServer\Contracts\Workers\Broadcast
{
    protected $message;
    protected $completed = false;
    protected $fails = [];

    public function __construct(NotifyMessage $message = null)
    {
        $this->message = $message;
    }

    public function getMessage(): ?NotifyMessage
    {
        return $this->message;
    }

    public function setMessage(NotifyMessage $message): \ADelf\LeaderServer\Contracts\Workers\Broadcast
    {
        $this->message = $message;

        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(): \ADelf\LeaderServer\Contracts\Workers\Broadcast
    {
        $this->completed = true;

        return $this;
    }

    public function registerFailedBroadcast(Worker $worker): \ADelf\LeaderServer\Contracts\Workers\Broadcast
    {
        $this->fails[] = $worker;

        return $this;
    }
}