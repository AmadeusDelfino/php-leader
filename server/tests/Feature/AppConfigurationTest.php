<?php


namespace Feature;


use Tests\TestBase;

class AppConfigurationTest extends TestBase
{
    public function test_app_configuration_get(): void
    {
        $this->assertEquals(is_string($this->app->config()->get('app.version')), true);
    }

    public function test_app_configuration_set(): void
    {
        $this->app->config()->set('foo', 'bar');
        $this->assertEquals($this->app->config()->get('foo'), 'bar');
    }
}