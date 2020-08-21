<?php


namespace ADelf\LeaderServer\RequestHandlers\Tcp;


use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\WorkerNotify\WorkerMessageRequest;

class ActionHandler extends TcpHandler
{
    protected $paramsValidate = [
        'action',
        'payload',
    ];

    public function __invoke()
    {
        $worker = $this->getWorker();
        $message = new WorkerMessageRequest($this->params);
        $response = $worker->request($message);

        return $message;
    }

    protected function getWorker(): Worker
    {
        while(true) {
            $work = works()->getAvailableWorkForAction($this->params->action);
            if($work !== null) {
                return $work;
            }
        }
    }
}