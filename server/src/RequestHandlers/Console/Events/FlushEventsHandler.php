<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Events;


use ADelf\LeaderServer\Contracts\Router\ConsoleRequest;
use Clue\React\Stdio\Stdio;

class FlushEventsHandler implements ConsoleRequest
{
    public function handler(array $params, Stdio $stdio): void
    {

    }
}