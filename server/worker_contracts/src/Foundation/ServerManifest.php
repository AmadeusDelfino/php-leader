<?php


namespace ADelf\LeaderWorker\Contracts;


interface ServerManifest
{
    public function __construct(array $args);

    public function get($key): string;
}