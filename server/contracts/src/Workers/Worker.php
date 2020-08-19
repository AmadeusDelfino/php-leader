<?php


namespace ADelf\LeaderServer\Contracts\Workers;


use React\Socket\ConnectionInterface;

interface Worker
{
    public function __construct(ConnectionInterface $connection, array $meta = []);

    public function getConnection(): ConnectionInterface;

    /**
     * Notify the worker asynchronously
     *
     * @param NotifyMessage $message
     * @return NotifyResponse
     */
    public function notify(NotifyMessage $message): NotifyResponse;

    /**
     * Request a task from the worker and wait for a response
     *
     * @param NotifyMessage $message
     * @return WorkerRequestResponse
     */
    public function request(NotifyMessage $message): WorkerRequestResponse;

    public function healthCheck(): WorkerHealthCheck;

    public function getLastNotificationResponse(): ?NotifyResponse;

    public function getLastRequestResponse(): ?WorkerRequestResponse;

    public function halt(): void;

    public function getId(): string;
}