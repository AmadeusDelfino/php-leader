<?php


namespace ADelf\LeaderServer\RequestHandlers;


use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Workers\Worker;

class RegisterNewWorkerHandler
{
    public function __invoke($ip, $port, $meta = [])
    {
        $worker = new Worker($ip, $port, $meta);
        app()->workersController()->addWorker($worker);

        return new \React\Http\Response(
            200,
            ['Content-Type' => 'text/plain'],
            json_encode($worker)
        );
    }
}