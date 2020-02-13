<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkerCpuUsage
{
    public function getCpuUsage(): float;

    public function getTotalCores(): int;

    public function getProcessList(): array;
}