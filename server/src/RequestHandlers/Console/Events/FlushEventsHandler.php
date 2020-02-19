<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Events;

use ADelf\LeaderServer\RequestHandlers\Console\Command;
use Clue\React\Stdio\Stdio;

class FlushEventsHandler extends Command
{
    protected $description = 'Clear all event items';

    public function handler(array $params, Stdio $stdio): void
    {
        eventController()->flush();
    }
}