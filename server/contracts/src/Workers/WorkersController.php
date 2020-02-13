<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface WorkersController
{
    /**
     * Adds a worker to the server
     * @param Worker $worker
     * @return $this
     */
    public function addWorker(Worker $worker) : self;

    /**
     * Send a broadcast message to all workers registered on the server
     * @param Broadcast $broadcast
     * @return Broadcast
     */
    public function broadcast(Broadcast $broadcast): Broadcast;


}