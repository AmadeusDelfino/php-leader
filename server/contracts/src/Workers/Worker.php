<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface Worker
{
    public function getIp(): string;

    public function getPort(): int;

    public function notify(): int;

    public function request();

    public function healthCheck(): WorkerHealthCheck;
}