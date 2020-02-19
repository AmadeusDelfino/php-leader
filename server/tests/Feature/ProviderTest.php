<?php


namespace Feature;


use Tests\Stubs\StubProvider;
use Tests\TestBase;

class ProviderTest extends TestBase
{
    public function test_register_new_provider(): void
    {
        $this->app->registerProvider(new StubProvider());
        $this->assertEquals($this->app->container('foo_property'), 'bar');
    }
}