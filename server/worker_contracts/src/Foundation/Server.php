<?php


namespace ADelf\LeaderWorker\Contracts;


interface Server
{
    public function __construct(string $ip, int $port, ServerManifest $manifest);

    public function getIp(): string;

    public function getPort(): int;

    public function ping(): bool;

    public function manifest(): ServerManifest;
}