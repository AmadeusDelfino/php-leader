<?php

if (!function_exists('event')) {
    function event(\ADelf\LeaderServer\Contracts\Event\EventFire $event)
    {
        (new \ADelf\LeaderServer\Services\EventService())->fire($event);
    }
}

if (!function_exists('app')) {
    function app(): \ADelf\LeaderServer\Contracts\Foundation\App
    {
        return \ADelf\LeaderServer\App::instance();
    }
}