<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkerRequestResponse
{
    public function getCode(): int;

    public function getResponseRaw(): string;

    public function getResponseAsArray(): array;

    public function getWorker(): Worker;
}