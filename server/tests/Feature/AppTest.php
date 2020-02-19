<?php


namespace Tests\Feature;


use ADelf\LeaderServer\App;
use ADelf\LeaderServer\Contracts\Foundation\AppConfiguration;
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
        $this->assertEquals($this->app->config() instanceof AppConfiguration, true);
    }

    public function test_app_container_accessor(): void
    {
        $this->app->registerProvider(new StubProvider());
        $this->assertEquals($this->app->container('foo_property'), 'bar');
        $this->assertEquals($this->app->container() instanceof Container, true);
    }
}