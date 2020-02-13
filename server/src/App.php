<?php


namespace ADelf\LeaderServer;


use ADelf\LeaderServer\Configuration\AppConfiguration;
use ADelf\LeaderServer\Contracts\Foundation\Provider;
use Pimple\Container;

class App implements \ADelf\LeaderServer\Contracts\Foundation\App
{
    PRIVATE CONST VERSION = '0.0.1';

    /**
     * @var Container
     */
    private $container;

    public function start(): int
    {
        $this->bootApp();
        return 0;
    }

    protected function bootApp(): void
    {
        $this->container = new Container();
        $this->container['config'] = new AppConfiguration();
    }

    public function config(): \ADelf\LeaderServer\Contracts\Foundation\AppConfiguration
    {
        return $this->container()['config'];
    }

    public function version(): string
    {
        return $this->config()->get('app.version');
    }

    public function terminate(): int
    {
        // TODO: Implement terminate() method.
    }

    public function container(): Container
    {
        return $this->container;
    }

    /**
     * @inheritDoc
     */
    public function registerProvider(Provider $provider)
    {
        // TODO: Implement registerProvider() method.
    }
}