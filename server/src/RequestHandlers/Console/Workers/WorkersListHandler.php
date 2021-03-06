<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Workers;

use ADelf\LeaderServer\Contracts\Workers\Worker;
use ADelf\LeaderServer\RequestHandlers\Console\Command;
use Clue\React\Stdio\Stdio;

class WorkersListHandler extends Command
{
    protected $description = 'List all workers available';


    protected function execute(Stdio $stdio): void
    {
        $stdio->write('Workers conectados: ' . PHP_EOL);
        foreach(app()->workersController()->getWorkers() as $worker) {
            /**
             * @var $worker Worker
             */
            $stdio->write(PHP_EOL .'----------------' . PHP_EOL);
            $stdio->write('ID: ' . $worker->getId());
        }
    }
}