<?php

require 'vendor/autoload.php';
require 'src/Supports/helpers.php';

use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Router\ConsoleRouterHandler;
use ADelf\LeaderServer\Router\RouterHandler;
use ADelf\LeaderServer\Services\WorkerPingService;
use Clue\React\Stdio\Stdio;
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

$loop->addPeriodicTimer($app->config()->get('workers.ping_time'), static function ($timer) {
    (new WorkerPingService())->pingAllWorkers();
});

$stdio = new Stdio($loop);
$stdio->setPrompt('Input > ');
$stdio->on('data', static function ($line) use($stdio) {
    (new ConsoleRouterHandler())->handler($line, $stdio);
});

$loop->run();