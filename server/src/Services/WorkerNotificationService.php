<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Contracts\Workers\WorkerMessageRequest;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\WorkerNotify\WorkerNotifyResponse;
use ADelf\LeaderServer\Workers\WorkRequestResponse;

class WorkerNotificationService
{
    public function notifyWorker(Worker $worker, WorkerMessageRequest $message): NotifyResponse
    {
        $response = new WorkerNotifyResponse();
        $worker->busy(true);
        $response->start();
        try {
            $worker->getConnection()->connection()->on('data', function ($data) use($response){
                var_dump($data);
                $response->setContent($data);
            });

            $worker->getConnection()->connection()->write($message->getPreparedContent());
            echo "start";
            waitValue($response, 'getContent');
            echo "end";

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
        $worker->getConnection()->connection()->on('data', function ($data) use($return, $messageRequest){
            $return = $data;
        });

        $worker->getConnection()->connection()->write($messageRequest->getPreparedContent());

        while(true) {
            if($return !== null) {
                return $return;
            }
        }

    }
}