<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;

class WorkRequestResponse implements WorkerRequestResponse
{
    protected $code;
    protected $rawResponse;
    protected $worker;
    protected $message;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getResponseRaw(): string
    {
        return $this->rawResponse;
    }

    public function getResponseAsArray(): array
    {
        return json_decode($this->getResponseRaw(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }

    public function setCode(int $code): WorkerRequestResponse
    {
        $this->code = $code;

        return $this;
    }

    public function setResponse(string $response): WorkerRequestResponse
    {
        $this->rawResponse = $response;

        return $this;
    }

    public function setWorker(Worker $worker): WorkerRequestResponse
    {
        $this->worker = $worker;

        return $this;
    }

    public function getMessage(): NotifyMessage
    {
        return $this->message;
    }

    public function setMessage(NotifyMessage $message): WorkerRequestResponse
    {
        $this->message = $message;

        return $this;
    }
}