<?php


namespace ADelf\LeaderServer\Contracts\Notification;


interface NotificationLog
{
    public function warning($message): void;

    public function info($message): void;

    public function error($message): void;
}