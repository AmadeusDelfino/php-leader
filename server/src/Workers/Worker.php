<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\WorkerHealthCheck;
use ADelf\LeaderServer\Services\WorkerNotificationService;

class Worker implements \ADelf\LeaderServer\Contracts\Workers\Worker
{
    protected $ip;
    protected $port;
    protected $meta;
    protected $lastNotificationResponse;

    public function __construct(string $ip, int $port, array $meta = [])
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->meta = $meta;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function getLastNotificationResponse(): NotifyResponse
    {
        return $this->lastNotificationResponse;
    }

    public function notify(NotifyMessage $message): NotifyResponse
    {
        $this->lastNotificationResponse = (new WorkerNotificationService())->notifyWorker($this, $message);
        return $this->lastNotificationResponse;
    }

    public function healthCheck(): WorkerHealthCheck
    {
        // TODO: Implement healthCheck() method.
    }
}