<?php


namespace ADelf\LeaderServer\Contracts\Notification;


interface RequestLog
{
    public function warning($message): void;

    public function info($message): void;

    public function error($message): void;
}