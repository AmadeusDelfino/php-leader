<?php


namespace Tests\Feature;

use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Contracts\Foundation\AppConfiguration;
use ADelf\LeaderServer\Contracts\Notification\NotificationLog;
use ADelf\LeaderServer\Contracts\Notification\RequestLog;
use ADelf\LeaderServer\Contracts\Workers\WorkersController;
use Pimple\Container;
use Tests\Stubs\StubProvider;
use Tests\TestBase;

class AppTest extends TestBase
{
    public function test_app_start(): void
    {
        $app = App::instance();
        $app->start();
        $this->assertEquals($app, \app());
    }

    public function test_app_config_accessor(): void
    {
        $this->assertInstanceOf(AppConfiguration::class, $this->app->config());
    }

    public function test_app_container_accessor(): void
    {
        $this->app->registerProvider(new StubProvider());
//        $this->assertEquals($this->app->container('foo_property'), 'bar');
        $this->assertInstanceOf(Container::class, $this->app->container());
    }

    public function test_app_version_accessor(): void
    {
        $this->assertEquals(is_string($this->app->version()), true);
    }

    public function test_app_workers_controller_accessor():void
    {
        $this->assertInstanceOf(WorkersController::class, $this->app->workersController());
    }

    public function test_app_request_log_accessor(): void
    {
        $this->assertInstanceOf(RequestLog::class, $this->app->requestLog());
    }

    public function test_app_notify_log_accessor(): void
    {
        $this->assertInstanceOf(NotificationLog::class, $this->app->notifyLog());
    }
}