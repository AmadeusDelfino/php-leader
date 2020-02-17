<?php


namespace ADelf\LeaderServer\RequestHandlers;


use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Workers\Worker;

class RegisterNewWorkerHandler
{
    public function __invoke($ip, $port, $meta = [])
    {
        app()->workersController()->addWorker(new Worker($ip, $port, $meta));
    }
}