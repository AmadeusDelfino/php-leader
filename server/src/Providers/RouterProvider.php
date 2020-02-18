<?php


namespace ADelf\LeaderServer\Providers;


use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\Router\ConsoleRouterHandler;
use ADelf\LeaderServer\Router\WebRouterHandler;
use Pimple\Container;

class RouterProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $pimple['webRouter'] = new WebRouterHandler();
        $pimple['consoleRouter'] = new ConsoleRouterHandler();
    }
}