<?php

require 'vendor/autoload.php';
require 'src/Supports/helpers.php';

use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Events\WorkerHaltEvent;
use ADelf\LeaderServer\Router\RouterHandler;
use ADelf\LeaderServer\Services\EventService;
use ADelf\LeaderServer\Services\WorkerPingService;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;

use React\Http\Server;


$app = App::instance();
$app->start();

$loop = Factory::create();
$server = new Server(static function (ServerRequestInterface $request) use (&$app) {
    try {
        return (new RouterHandler())->handler($request);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
});
$port = app()->config()->get('app.port');
$socket = new \React\Socket\Server($port, $loop);
$server->listen($socket);

echo 'Server running at port ' . $port;

$loop->addPeriodicTimer(0.1, static function ($timer) {
    if(($event = app()->eventPop()) !== null) {
        (new EventService())->execute($event);
    }
});
$loop->addPeriodicTimer(3, static function($timer) {
    (new EventService())->fire(new WorkerHaltEvent(['teste']));
});
$loop->addPeriodicTimer($app->config()->get('workers.ping_time'), static function ($timer) {
    (new WorkerPingService())->pingAllWorkers();
});
$loop->addPeriodicTimer(1, static function ($timer) {
    echo "Events: \n";
    echo json_encode(app()->events());
    echo "\n";
});

$loop->run();