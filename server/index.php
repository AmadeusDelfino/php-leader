<?php

require 'vendor/autoload.php';
require 'src/Supports/helpers.php';
require 'bootstrap/app.php';
require 'bootstrap/stdio.php';
require 'bootstrap/http.php';

use ADelf\LeaderServer\Services\WorkerPingService;


$loop->addPeriodicTimer($app->config()->get('workers.ping_time'), static function ($timer) {
    (new WorkerPingService())->pingAllWorkers();
    (new \ADelf\LeaderServer\Services\CacheService())->set(rand(1, 999), 'teste');
});



$loop->run();