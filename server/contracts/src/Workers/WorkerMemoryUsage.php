<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkerMemoryUsage
{
    public function getUsed(): int;

    public function getFree(): int;
}