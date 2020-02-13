<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface NotifyResponse
{
    public function getStartTime(): int;

    public function getEndTime(): int;

    public function getTotalTime(): int;

    public function isSuccess();
}