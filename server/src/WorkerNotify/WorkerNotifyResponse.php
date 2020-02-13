<?php


namespace ADelf\LeaderServer\WorkerNotify;


use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;

class WorkerNotifyResponse implements NotifyResponse
{
    protected $startTime;
    protected $endTime;
    protected $success = false;

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function getEndTime(): int
    {
        return $this->endTime;
    }

    public function getTotalTime(): int
    {
        return $this->endTime - $this->startTime;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(): void
    {
        $this->success = true;
    }

    public function start() : void
    {
        $this->startTime = microtime(true);
    }

    public function end(): void
    {
        $this->endTime = microtime(true);
    }
}