<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Worker
{
    public function __construct(string $ip, int $port, array $meta = []);

    public function getIp(): string;

    public function getPort(): int;

    public function getMeta(): array;

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