<?php


namespace ADelf\LeaderServer\Workers;


use ADelf\LeaderServer\Contracts\Workers\Broadcast;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\WorkerNotify\NotifyMessage;

class WorkersController implements \ADelf\LeaderServer\Contracts\Workers\WorkersController
{
    protected $works = [];

    /**
     * @inheritDoc
     */
    public function addWorker(Worker $worker): \ADelf\LeaderServer\Contracts\Workers\WorkersController
    {
        $this->works[] = $worker;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function broadcast(Broadcast $broadcast): Broadcast
    {
        #TODO validar mensagem nulla
        $message = $broadcast->getMessage();

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
        $broadcast = new \ADelf\LeaderServer\WorkerNotify\Broadcast(new NotifyMessage(['halt' => 'now']));
        $this->broadcast($broadcast);
    }
}