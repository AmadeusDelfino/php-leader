<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\Broadcast;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Events\WorkerHaltEvent;
use ADelf\LeaderServer\Exceptions\NullMessageException;
use ADelf\LeaderServer\WorkerActions\Enums\Actions;
use ADelf\LeaderServer\WorkerNotify\NotifyMessage;

class WorkersController implements \ADelf\LeaderServer\Contracts\Workers\WorkersController
{
    protected $works = [];

    /**
     * @inheritDoc
     */
    public function addWorker(Worker $worker): Worker
    {
        $this->works[$worker->getIp() . $worker->getPort()] = $worker;

        return $worker;
    }

    public function getWorkers(): array
    {
        return $this->works;
    }

    public function getWorker($id): ?Worker
    {
        return $this->works[$id] ?? null;
    }


    /**
     * @inheritDoc
     */
    public function broadcast(Broadcast $broadcast): Broadcast
    {
        if(($message = $broadcast->getMessage()) === null) {
            throw new NullMessageException();
        }

        foreach($this->works as $work) {
            /**
             * @var $work Worker
             */
            if(!$work->notify($message)->isSuccess()) {
                $broadcast->registerFailedBroadcast($work);
            }
        }

        $broadcast->setCompleted();

        return $broadcast;
    }

    public function haltAllWorks(): void
    {
        $broadcast = new \ADelf\LeaderServer\WorkerNotify\Broadcast(new NotifyMessage(Actions::HALT));
        $this->broadcast($broadcast);
    }

    public function haltWorker(Worker $worker): void
    {
        $worker->notify(new NotifyMessage(Actions::HALT));
        unset($this->works[$worker->getId()]);
        event(new WorkerHaltEvent($worker));
    }

    public function syncWithServer():void
    {
        $broadcast = new \ADelf\LeaderServer\WorkerNotify\Broadcast(new NotifyMessage(Actions::RESYNC_WITH_SERVER));
        $this->works = [];
        $this->broadcast($broadcast);
    }

    public function ping(Worker $worker): bool
    {
        $response = $worker->notify(new NotifyMessage(Actions::PING));
        if(!$response->isSuccess()) {
            $this->haltWorker($worker);
            return false;
        }

        return true;
    }
}