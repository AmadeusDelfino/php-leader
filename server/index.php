<?php

require 'vendor/autoload.php';
require 'src/Supports/helpers.php';

use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Services\WorkerPingService;


$app = App::instance();
$app->start();

$loop = \React\EventLoop\Factory::create();
$server = new \React\Http\Server(static function (\Psr\Http\Message\ServerRequestInterface $request) use (&$app) {
    try {
        if ($request->getMethod() !== 'POST') {
            return new \React\Http\Response(
                405,
                ['Content-Type' => 'text/plain'],
                'Use method post'
            );
        }

        $path = $request->getUri()->getPath();
        if (strcmp($path, '/register') === 0) {
            $params = $request->getParsedBody();
            (new \ADelf\LeaderServer\RequestHandlers\RegisterNewWorkerHandler())($params['ip'], $params['port'], $request->getHeaders());
            return new \React\Http\Response(
                200,
                ['Content-Type' => 'text/plain'],
                json_encode($app->workersController()->getWorkers())
            );
        }

        return new \React\Http\Response(
            200,
            ['Content-Type' => 'text/plain'],
            $path
        );
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
});
$socket = new \React\Socket\Server(8080, $loop);
$server->listen($socket);

echo 'Serve running at port 8080';

$loop->addPeriodicTimer(1, static function ($timer) {
    (new \ADelf\LeaderServer\Services\EventService())->fire(new \ADelf\LeaderServer\Events\WorkerHaltEvent(['teste']));
});
$loop->addPeriodicTimer($app->config()->get('workers.ping_time'), static function ($timer) {
    echo 'pinged';
    (new WorkerPingService())->pingAllWorkers();
});

$loop->run();