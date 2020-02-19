<?php


namespace ADelf\LeaderWorker\Contracts;


interface Worker
{
    public function start(): void;
}