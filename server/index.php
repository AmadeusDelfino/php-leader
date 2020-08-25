<?php

require 'vendor/autoload.php';
require 'src/Supports/helpers.php';
require 'bootstrap/app.php';
require 'bootstrap/http.php';

if ($app->config()->get('app.enable_shell')) {
    require 'bootstrap/stdio.php';
}

//$loop->addPeriodicTimer($app->config()->get('workers.ping_time'), static function ($timer) {
//    (new WorkerPingService())->pingAllWorkers();
//    echo "ping";
//});

$loop->run();