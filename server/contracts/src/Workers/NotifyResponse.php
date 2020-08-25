<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface NotifyResponse
{
    public function getStartTime(): int;

    public function getEndTime(): int;

    public function getTotalTime(): int;

    public function isSuccess(): bool ;

    public function setSuccess(): void;

    public function start(): void;

    public function end(): void;

    public function setContent(string $content): void;

    public function getContent(): ?string;
}