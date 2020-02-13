<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\Broadcast;
use ADelf\LeaderServer\Contracts\Workers\Worker;

class WorkersController implements \ADelf\LeaderServer\Contracts\Workers\WorkersController
{
    protected $works = [];

    /**
     * @inheritDoc
     */
    public function addWorker(Worker $worker): \ADelf\LeaderServer\Contracts\Workers\WorkersController
    {
        // TODO: Implement addWorker() method.
    }

    /**
     * @inheritDoc
     */
    public function broadcast(Broadcast $broadcast): \ADelf\LeaderServer\Contracts\Workers\WorkersController
    {
        // TODO: Implement broadcast() method.
    }
}