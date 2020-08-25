<?php

return [
    'name' => env('SERVER_NAME', 'Leader Server'),
    'version' => env('SERVER_VERSION', '0.0.1'),
    'port' => env('SERVER_PORT', 8080),
    'tcp_port' => env('TCP_PORT', 7171),
    'enable_shell' => env('ENABLE_SHELL', false),
];