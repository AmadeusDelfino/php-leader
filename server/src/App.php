<?php


namespace ADelf\LeaderServer;

use Adelf\Config\Singletonable;
use ADelf\LeaderServer\Contracts\Foundation\App as IApp;
use ADelf\LeaderServer\Contracts\Foundation\AppConfiguration as IAppConfiguration;
use ADelf\LeaderServer\Contracts\Foundation\Provider;
use ADelf\LeaderServer\Contracts\Notification\RequestLog;
use ADelf\LeaderServer\Contracts\Workers\WorkersController;
use ADelf\LeaderServer\Log\NotifyLog;
use ADelf\LeaderServer\Providers\AppProvider;
use Pimple\Container;

class App extends Singletonable implements IApp
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
        $this->registerAppProviders();
    }

    protected function registerAppProviders(): void
    {
        foreach($this->config()->get('providers') as $provider) {
            if(!class_exists($provider)) {
                throw new \Exception('Provider not found:' . $provider);
            }

            $this->registerProvider(new $provider());
        }
    }

    public function config(): IAppConfiguration
    {
        return $this->container()['config'];
    }

    public function version(): string
    {
        return $this->config()->get('app.version');
    }

    public function workersController(): WorkersController
    {
        return $this->container('workersController');
    }

    public function terminate(): int
    {
        $this->workersController()->haltAllWorks();
    }

    public function container($key = null)
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
        $this->container->register($provider);
    }

    public function requestLog(): RequestLog
    {
        return $this->container('requestLog');
    }

    public function notifyLog(): NotifyLog
    {
        return $this->container('notifyLog');
    }
}