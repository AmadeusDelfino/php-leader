<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\WorkerMessageRequest;
use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\WorkerNotify\WorkerNotifyResponse;
use ADelf\LeaderServer\Workers\WorkRequestResponse;
use React\Socket\ConnectionInterface;

class WorkerNotificationService
{
    public function notifyWorker(Worker $worker, WorkerMessageRequest $message): NotifyResponse
    {
        $response = new WorkerNotifyResponse();
        $worker->busy(true);
        $response->start();
        try {
            $worker->getConnection()->on('data', function ($data) use($response){
                $response->setContent($data);
            });

            $worker->getConnection()->write($message->getPreparedContent());

            waitValue($response, 'getContent');

            $response->setSuccess();
            $response->end();
        } catch (\Exception $e) {
            #TODO handler exception
            $response->end();
        }
        $worker->busy(false);

        return $response;
    }

    public function syncRequestToWorker(Worker $worker, WorkerMessageRequest $message): WorkerRequestResponse
    {
        $response = new WorkRequestResponse();
        $response->setResponse($this->syncRequest($worker, $message));
        $response
            ->setCode(200)
            ->setWorker($worker)
            ->setMessage($message);

        return $response;
    }

    protected function syncRequest(Worker $worker, WorkerMessageRequest $messageRequest)
    {
        $return = null;
        $worker->getConnection()->on('data', function ($data) use($return, $messageRequest){
            $return = $data;
        });

        $worker->getConnection()->write($messageRequest->getPreparedContent());

        while(true) {
            if($return !== null) {
                return $return;
            }
        }

    }
}