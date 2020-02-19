<?php


namespace ADelf\LeaderWorker;


use ADelf\LeaderWorker\Contracts\ServerManifest;

class Server implements Contracts\Server
{
    protected $ip = '';
    protected $port = 0;
    protected $manifest;

    public function __construct(string $ip, int $port, ServerManifest $manifest)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->manifest = $manifest;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function ping(): bool
    {
        // TODO: Implement ping() method.
    }

    public function manifest(): ServerManifest
    {
        return $this->manifest;
    }
}