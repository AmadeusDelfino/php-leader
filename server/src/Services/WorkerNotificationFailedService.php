<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\Broadcast;
use ADelf\LeaderServer\Contracts\Workers\Worker;

class WorkerNotificationFailedService
{
    public function handleFailed(Broadcast $broadcast)
    {
        $app = app();
        foreach($broadcast->failedWorkers() as $work) {
            #TODO implementar lógica para verificar o motivo do work não ter funcionado
            #TODO casos previsto: código em versão diferente do esperado / work offline / http error
            #TODO notificar tais casos
            /**
             * @var $work Worker
             */
            $app->workersController()->haltWorker($work);
        }
    }
}