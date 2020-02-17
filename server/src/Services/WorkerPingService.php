<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\Worker;

class WorkerPingService
{
    public function pingAllWorkers(): void
    {
        $app = app();
        foreach($app->workersController()->getWorkers() as $worker) {
            /**
             * @var $worker Worker
             */
            $app->workersController()->ping($worker);
        }
    }
}