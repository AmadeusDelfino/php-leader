<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Events;

use ADelf\LeaderServer\RequestHandlers\Console\Command;
use Clue\React\Stdio\Stdio;

class CountEventsHandler extends Command
{
    protected $description = 'Count os event items';

    public function handler(array $params, Stdio $stdio): void
    {
        $stdio->write('Total: ' . count(eventController()->events()));
    }
}