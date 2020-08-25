<?php


namespace ADelf\LeaderServer\WorkerNotify;


use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;

class WorkerNotifyResponse implements NotifyResponse
{
    protected $startTime = 0;
    protected $endTime = 0;
    protected $success = false;
    protected $content;

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

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}