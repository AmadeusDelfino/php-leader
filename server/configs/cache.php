<?php

return [
    'driver' => env('CACHE_DRIVER', 'array'),

    'drivers' => [
        'array' => \ADelf\LeaderServer\Cache\Factories\ArrayFactory::class,
    ],

    'driver_configurations' => [ // Add connection params
        'redis' => [],
        'mysql' => [],
    ]
];
