<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Worker
{
    public function getIp(): string;

    public function getPort(): int;

    public function notify(NotifyMessage $message): NotifyResponse;

    public function request();

    public function healthCheck(): WorkerHealthCheck;

    public function getLastNotificationResponse(): NotifyResponse;
}