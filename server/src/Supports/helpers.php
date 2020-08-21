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

if (!function_exists('works')) {
    function works(): \ADelf\LeaderServer\Contracts\Workers\WorkersController
    {
        return app()->container('workersController');
    }
}

if (!function_exists('waitValue')) {
    function waitValue($class, string $method, $params = [])
    {
        while(true) {
            if(($result = $class->{$method}(...$params)) !== null) {
                return $result;
            }
        }
    }
}