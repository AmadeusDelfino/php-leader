<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\WorkerHealthCheck;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\Services\WorkerNotificationService;
use React\Socket\ConnectionInterface;

class Worker implements \ADelf\LeaderServer\Contracts\Workers\Worker
{
    protected $meta;
    protected $lastNotificationResponse;
    protected $lastRequestResponse;
    protected $connection;

    public function __construct(ConnectionInterface $connection, array $meta = [])
    {
        $this->connection = $connection;
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

    public function getLastNotificationResponse(): ?NotifyResponse
    {
        return $this->lastNotificationResponse;
    }

    public function getLastRequestResponse(): ?WorkerRequestResponse
    {
        return $this->lastRequestResponse;
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

    public function halt(): void
    {

    }

    /**
     * @inheritDoc
     */
    public function request(NotifyMessage $message): WorkerRequestResponse
    {
        $this->lastRequestResponse = (new WorkerNotificationService())->requestToWorker($this, $message);
        return $this->lastRequestResponse;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}