<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkerHealthCheck
{
    public function getUpTime(): int;

    public function getMemoryUsage(): WorkerMemoryUsage;

    public function getCpuUsage(): WorkerCpuUsage;
}