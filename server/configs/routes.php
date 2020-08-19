<?php

return [
    'web' => [
        '/register' => \ADelf\LeaderServer\RequestHandlers\RegisterNewWorkerHandler::class,
    ],
    'console' => [
        // Events
        'events:count' => \ADelf\LeaderServer\RequestHandlers\Console\Events\CountEventsHandler::class,
        'events:flush' => \ADelf\LeaderServer\RequestHandlers\Console\Events\FlushEventsHandler::class,

        // Cache
        'cache:count' => \ADelf\LeaderServer\RequestHandlers\Console\Cache\CountCacheHandler::class,
        'cache:flush' => \ADelf\LeaderServer\RequestHandlers\Console\Cache\FlushCacheHandler::class,

        // help
        'help' => \ADelf\LeaderServer\RequestHandlers\Console\HelpHandler::class,
    ],
    'tcp' => [
        'ping' => \ADelf\LeaderServer\RequestHandlers\Tcp\PingHandler::class,
    ]
];