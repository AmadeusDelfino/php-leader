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
    public function addWorker(Worker $worker): string;

    public function getWorker(string $id): ?Worker;

    public function removeWorker(string $id): void;

    public function getWorkers(): array;

    /**
     * Send a broadcast message to all workers registered on the server
     * @param Broadcast $broadcast
     * @return Broadcast
     * @throws NullMessageException
     */
    public function broadcast(Broadcast $broadcast): Broadcast;

    public function haltAllWorks(): void;

    public function haltWorker(Worker $worker): void;

    public function syncWithServer(): void;

    public function ping(Worker $worker): bool;

    public function getAvailableWorkForAction($action): ?Worker;
}