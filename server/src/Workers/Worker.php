<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Connection;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\WorkerHealthCheck;
use ADelf\LeaderServer\Contracts\Workers\WorkerMessageRequest;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\Services\WorkerNotificationService;

class Worker implements \ADelf\LeaderServer\Contracts\Workers\Worker
{
    protected $id;
    protected $meta;
    protected $lastNotificationResponse;
    protected $lastRequestResponse;
    protected $connection;
    protected $busy = false;
    protected $actionsAvailable = [];

    public function __construct(Connection $connection, array $meta = [])
    {
        $this->connection = $connection;
        $this->meta = $meta;
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

    public function notify(WorkerMessageRequest $message): NotifyResponse
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
    public function request(WorkerMessageRequest $message): WorkerRequestResponse
    {
        $this->lastRequestResponse = (new WorkerNotificationService())->syncRequestToWorker($this, $message);
        return $this->lastRequestResponse;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }

    public function busy(?bool $busy = null): bool
    {
        if(is_bool($busy)) {
            $this->busy = $busy;

            return true;
        }

        return $this->busy;
    }

    public function hasAction(string $action): bool
    {
        return in_array($action, $this->actionsAvailable);
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}