<?php


namespace ADelf\LeaderServer;


use ADelf\LeaderServer\Configuration\AppConfiguration;
use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\Providers\AppProvider;
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
        $this->container->register(new AppProvider());
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

    public function container($key = null): Container
    {
        if($key === null) {
            return $this->container;
        }

        return $this->container[$key];
    }

    /**
     * @inheritDoc
     */
    public function registerProvider(Provider $provider)
    {
        // TODO: Implement registerProvider() method.
    }
}