<?php


namespace ADelf\LeaderWorker;


class ServerManifest implements Contracts\ServerManifest
{
    protected $args = [];

    public function __construct(array $args)
    {
        $this->args = $args;
    }

    public function get($key, $default = null): string
    {
        return $this->args[$key] ?? $default;
    }
}