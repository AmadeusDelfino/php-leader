<?php


namespace Feature;


use ADelf\LeaderServer\Contracts\Workers\NotifyResponse;
use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\Contracts\Workers\WorkerRequestResponse;
use ADelf\LeaderServer\WorkerNotify\NotifyMessage;
use Tests\TestBase;

class WorkerTest extends TestBase
{
    public function test_request_to_worker(): Worker
    {
        $worker = new \ADelf\LeaderServer\Workers\Worker('127.0.0.1', '5050');
        $this->assertInstanceOf(WorkerRequestResponse::class, $worker->request(new NotifyMessage(['test' => 'test'])));

        return $worker;
    }

    public function test_notify_to_worker(): Worker
    {
        $worker = new \ADelf\LeaderServer\Workers\Worker('127.0.0.1', '5050');
        $this->assertInstanceOf(NotifyResponse::class, $worker->notify(new NotifyMessage(['teste' => 'teste'])));

        return $worker;
    }

    /**
     * @@depends test_request_to_worker
     */
    public function test_last_request_attribute(Worker $worker): void
    {
        $this->assertInstanceOf(WorkerRequestResponse::class, $worker->getLastRequestResponse());
    }

    /**
     * @depends test_notify_to_worker
     */
    public function test_last_notify_attribute(Worker $worker): void
    {
        $this->assertInstanceOf(NotifyResponse::class, $worker->getLastNotificationResponse());
    }

    /**
     * @depends test_request_to_worker
     */
    public function test_get_meta(Worker $worker): void
    {
        $this->assertEquals(is_array($worker->getMeta()), true);
    }

    /**
     * @depends test_request_to_worker
     */
    public function test_work_request_actions(Worker $worker): void
    {
        $request = $worker->getLastRequestResponse();
        $this->assertIsInt($request->getCode());
        $this->assertIsString($request->getResponseRaw());
        #TODO adicionar worker real para melhores testes
//        $this->assertIsArray($request->getResponseAsArray());
//        $this->assertInstanceOf(Worker::class, $request->getWorker());
//        $this->assertInstanceOf(NotifyResponse::class, $request->getMessage());

    }

    /**
     * @depends test_notify_to_worker
     */
    public function test_work_notify_actions(Worker $worker): void
    {
        $notify = $worker->getLastNotificationResponse();
        $this->assertIsInt($notify->getStartTime());
        $this->assertIsInt($notify->getEndTime());
        $this->assertIsInt($notify->getTotalTime());
    }
}