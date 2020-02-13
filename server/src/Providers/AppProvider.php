<?php


namespace ADelf\LeaderServer\Providers;


use ADelf\LeaderServer\Configuration\AppConfiguration;
use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\Workers\WorkersController;
use Pimple\Container;

class AppProvider implements Provider
{
    public function register(Container $container)
    {
        $container['config'] = new AppConfiguration();
        $container['workersController'] = new WorkersController();
    }
}