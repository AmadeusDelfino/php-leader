<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkerRequestResponse
{
    public function getCode(): int;

    public function setCode(int $code): self;

    public function getResponseRaw(): string;

    public function getResponseAsArray(): array;

    public function setResponse(string $response): self;

    public function getWorker(): Worker;

    public function setWorker(Worker $worker): self;

    public function getMessage(): NotifyMessage;

    public function setMessage(NotifyMessage $message): self;
}