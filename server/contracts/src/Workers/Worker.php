<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Worker
{
    public function __construct(string $ip, int $port, array $meta = []);

    public function getIp(): string;

    public function getPort(): int;

    public function getMeta(): array;

    public function notify(NotifyMessage $message): NotifyResponse;

    public function healthCheck(): WorkerHealthCheck;

    public function getLastNotificationResponse(): NotifyResponse;

    public function halt(): void;
}