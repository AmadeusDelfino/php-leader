<?php


namespace ADelf\LeaderServer\Contracts\Foundation;


interface App
{
    public function start(): int;

    public function version(): string;

    public function configPath(): string;

    public function terminate(): int;
}