<?php


namespace ADelf\LeaderServer\Contracts\Workers;


use ADelf\LeaderServer\Connection;

interface Worker
{
    public function __construct(Connection $connection, array $meta = []);

    public function getConnection(): Connection;

    /**
     * Notify the worker asynchronously
     *
     * @param WorkerMessageRequest $message
     * @return NotifyResponse
     */
    public function notify(WorkerMessageRequest $message): NotifyResponse;

    /**
     * Request a task from the worker and wait for a response
     *
     * @param WorkerMessageRequest $message
     * @return WorkerRequestResponse
     */
    public function request(WorkerMessageRequest $message): WorkerRequestResponse;

    public function healthCheck(): WorkerHealthCheck;

    public function getLastNotificationResponse(): ?NotifyResponse;

    public function getLastRequestResponse(): ?WorkerRequestResponse;

    public function halt(): void;

    public function setId(string $id): void;

    public function busy(?bool $busy = null): bool;

    public function hasAction(string $action): bool;
}