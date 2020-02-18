<?php

if (!function_exists('app')) {
    function app(): \ADelf\LeaderServer\Contracts\Foundation\App
    {
        return \ADelf\LeaderServer\App::instance();
    }
}

if (!function_exists('event')) {
    function event(\ADelf\LeaderServer\Contracts\Event\EventFire $event)
    {
        (new \ADelf\LeaderServer\Services\EventService())->fire($event);
    }
}

if (!function_exists('config')) {
    function config(): \ADelf\LeaderServer\Contracts\Foundation\AppConfiguration
    {
        return app()->config();
    }
}

if (!function_exists('eventController')) {
    function eventController(): \ADelf\LeaderServer\Contracts\Event\EventController
    {
        return app()->container('eventController');
    }
}

if (!function_exists('cache')) {
    function cache(): \ADelf\LeaderServer\Contracts\Cache\CacheInterface
    {
        return app()->container('cacheController');
    }
}