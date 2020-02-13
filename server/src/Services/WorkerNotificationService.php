<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\WorkerNotify\WorkerNotifyResponse;

class WorkerNotificationService
{
    public function notifyWorker(Worker $worker, NotifyMessage $message): NotifyResponse
    {
        $response = new WorkerNotifyResponse();
        $response->start();
        try{
            #TODO código para realizar request;
            $response->setSuccess();
            $response->end();
        } catch (\Exception $e) {
            #TODO handler exception
            $response->end();
        }

        return $response;
    }
}