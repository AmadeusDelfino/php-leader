<?php


namespace ADelf\LeaderServer;


class App implements \ADelf\LeaderServer\Contracts\Foundation\App
{
    PRIVATE CONST VERSION = '0.0.1';

    public function start(): int
    {
        echo "I'm alive!";

        return 0;
    }

    public function version(): string
    {
        return $this::VERSION;
    }

    public function configPath(): string
    {
        // TODO: Implement configPath() method.
    }

    public function terminate(): int
    {
        // TODO: Implement terminate() method.
    }
}