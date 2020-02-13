<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\NotifyMessage;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\WorkerNotify\WorkerNotifyResponse;
use ADelf\LeaderServer\Workers\WorkRequestResponse;

class WorkerNotificationService
{
    public function notifyWorker(Worker $worker, NotifyMessage $message): NotifyResponse
    {
        $response = new WorkerNotifyResponse();
        $response->start();
        try {
            #TODO código para realizar request;
            $response->setSuccess();
            $response->end();
        } catch (\Exception $e) {
            #TODO handler exception
            $response->end();
        }

        return $response;
    }

    public function requestToWorker(Worker $worker, NotifyMessage $message): WorkerRequestResponse
    {
        $response = new WorkRequestResponse();
        #TODO código para realizar request ao worker
        $response
            ->setResponse(json_encode(['teste' => 'teste'], JSON_THROW_ON_ERROR))
            ->setCode(200)
            ->setWorker($worker)
            ->setMessage($message);

        return $response;
    }
}