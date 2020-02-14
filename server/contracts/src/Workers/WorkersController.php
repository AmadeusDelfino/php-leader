<?php


namespace ADelf\LeaderServer\Contracts\Workers;


use ADelf\LeaderServer\Exceptions\NullMessageException;

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
     * @throws NullMessageException
     * @return Broadcast
     */
    public function broadcast(Broadcast $broadcast): Broadcast;

    public function haltAllWorks(): void;

    public function haltWorker(Worker $worker): void;

    public function syncWithServer():void;
}