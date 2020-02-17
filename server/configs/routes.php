<?php

return [
    'web' => [
        '/register' => \ADelf\LeaderServer\RequestHandlers\RegisterNewWorkerHandler::class,
    ],
    'console' => [
        'events:count' => \ADelf\LeaderServer\RequestHandlers\Console\Events\CountEventsHandler::class,
        'events:flush' => \ADelf\LeaderServer\RequestHandlers\Console\Events\FlushEventsHandler::class,
    ]
];