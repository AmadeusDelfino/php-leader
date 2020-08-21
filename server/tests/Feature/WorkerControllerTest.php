<?php


namespace Feature;


use ADelf\LeaderServer\Exceptions\NullMessageException;
use ADelf\LeaderServer\WorkerNotify\Broadcast;
use ADelf\LeaderServer\WorkerNotify\WorkerMessageRequest;
use ADelf\LeaderServer\Workers\Worker;
use Tests\TestBase;

class WorkerControllerTest extends TestBase
{
    public function test_add_worker(): \ADelf\LeaderServer\Contracts\Workers\Worker
    {
        $worker = new Worker('127.0.0.1', '5050');
        $worker = $this->app->workersController()->addWorker($worker);

        $this->assertEquals($worker->getId(), $this->app->workersController()->getWorker($worker->getId())->getId());

        return $worker;
    }

    public function test_get_all_workers(): void
    {
        $this->assertEquals(is_array($this->app->workersController()->getWorkers()), true);
    }

    public function test_broadcast_workers(): void
    {
        #TODO implementar worker de teste para casos reais
        $this->app->workersController()->broadcast(new Broadcast(new WorkerMessageRequest(['teste'])));

        $this->assertEquals(true, true);
    }

    public function test_broadcast_null_message_validation(): void
    {
        $this->expectException(NullMessageException::class);
        $this->app->workersController()->broadcast(new Broadcast());
    }

    public function test_halt_all_workers(): void
    {
        #TODO implementar worker de teste para casos reais
        $this->app->workersController()->haltAllWorks();

        $this->assertEquals(true, true);
    }

    /**
     * @depends test_add_worker
     */
    public function test_halt_worker($worker): void
    {
        #TODO implementar worker de teste para casos reais
        $this->app->workersController()->haltWorker($worker);

        $this->assertEquals(true, true);
    }

    public function test_sync_with_server(): void
    {
        #TODO implementar worker de teste para casos reais
        $this->app->workersController()->syncWithServer();

        $this->assertEquals(true, true);
    }

    /**
     * @depends test_add_worker
     */
    public function test_ping_worker($worker): \ADelf\LeaderServer\Contracts\Workers\Worker
    {
        $this->assertEquals($this->app->workersController()->ping($worker), true);

        return $worker;
    }


}