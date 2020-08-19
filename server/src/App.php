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
use ADelf\LeaderServer\Router\TcpRouterHandler;
use Pimple\Container;
use React\EventLoop\Factory;
use React\Socket\ConnectionInterface;
use React\Socket\Server;
use React\Stream\WritableResourceStream;

class App extends Singletonable implements IApp
{
    /**
     * @var Container
     */
    private $container;
    protected $loop;
    protected $socket;

    protected $events = [];

    public function start(): int
    {
        $this->bootApp();
        return 1;
    }

    protected function bootApp(): void
    {
        $this->container = new Container();
        $this->container->register(new AppProvider());
        $this->registerAppProviders();
        $this->startReactLoop();
        $this->startSocketTcp();
    }

    protected function startSocketTcp(): void
    {
        $this->socket = new Server('127.0.0.1:' . app()->config()->get('app.tcp_port'), $this->loop);
        $stdout = new WritableResourceStream(\STDOUT, $this->loop);

        $this->socket->on('connection', static function(ConnectionInterface $connection) use ($stdout){
            $connection->on('data', static function($data) use ($connection, $stdout) {
                try {
                    $connection->write((new TcpRouterHandler())->handler($data));
                } catch (\Exception $e) {
                    $stdout->write('['.$e->getCode().'] An exception ocurred: ' . $e->getMessage() . PHP_EOL);
                    $stdout->write($e->getTraceAsString());
                }
            });
            $stdout->write('Client ['.$connection->getRemoteAddress().'] connected' . PHP_EOL);
        });

        $stdout->write('Socket TCP listening on: ' . $this->socket->getAddress() . "\n");
    }

    protected function startReactLoop(): void
    {
        $this->loop = Factory::create();
    }

    public function reactLoop()
    {
        return $this->loop;
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