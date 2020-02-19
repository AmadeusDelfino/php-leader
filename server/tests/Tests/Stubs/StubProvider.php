<?php


namespace Tests\Stubs;


use ADelf\LeaderServer\Contracts\Foundation\Provider;
use Pimple\Container;

class StubProvider implements Provider
{
    public function register(Container $pimple)
    {
        $pimple['foo_property'] = 'bar';
    }
}