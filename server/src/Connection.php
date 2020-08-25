<?php


namespace ADelf\LeaderServer;


use ADelf\LeaderServer\Router\TcpRouterHandler;
use React\Socket\ConnectionInterface;
use React\Stream\WritableResourceStream;

class Connection
{
    protected $connection;
    protected $canOverrideDataListener = true;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function connection(): ConnectionInterface
    {
        return $this->connection;
    }

    public function canOverride($can = null)
    {
        if (is_numeric($can)) {
            return $this->canOverrideDataListener;
        }

        $this->canOverrideDataListener = $can;
    }

    public function implementDefaultDataListener()
    {
        $connection = $this->connection;
        $stdout = new WritableResourceStream(\STDOUT, app()->reactLoop());

        $connection->on('data', function ($data) use ($connection, $stdout) {
            try {
                $connection->write((new TcpRouterHandler())->handler(['data' => $data, 'connection' => $this]));
                $stdout->write('Client ['.$connection->getRemoteAddress().'] connected' . PHP_EOL);
            } catch (\Exception $e) {
                $stdout->write('[' . $e->getCode() . '] An exception occurred: ' . $e->getMessage() . PHP_EOL);
                $stdout->write($e->getTraceAsString());
            }
        });
        $connection->on('close', static function () use ($stdout, $connection) {
            works()->removeWorker($connection->getRemoteAddress());
            $stdout->write('[' . $connection->getRemoteAddress() . '] - Disconnected');
        });
    }

    public function overrideDataListener($callback)
    {
        if(!is_callable($callback)) {
            throw new \InvalidArgumentException();
        }

        if(!$this->canOverride()) {
            throw new \Exception('Can\'t override data listener');
        }

        $this->connection->on('data', $callback);
    }
}