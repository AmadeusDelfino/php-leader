<?php


namespace ADelf\LeaderServer;


use ADelf\LeaderServer\Contracts\Foundation\Provider;
use Pimple\Container;

class App implements \ADelf\LeaderServer\Contracts\Foundation\App
{
    PRIVATE CONST VERSION = '0.0.1';
    private $container;

    public function start(): int
    {
        $this->container = new Container();
        echo "I'm alive!";

        return 0;
    }

    public function version(): string
    {
        return $this::VERSION;
    }

    public function configPath($path = null): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'configs/';
    }

    public function terminate(): int
    {
        // TODO: Implement terminate() method.
    }

    public function container() : Container
    {

    }

    /**
     * @inheritDoc
     */
    public function registerProvider(Provider $provider)
    {
        // TODO: Implement registerProvider() method.
    }
}