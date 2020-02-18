<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Cache;


use ADelf\LeaderServer\Contracts\Router\ConsoleRequest;
use Clue\React\Stdio\Stdio;

class CountCacheHandler implements ConsoleRequest
{
    public function handler(array $params, Stdio $stdio): void
    {
        $stdio->write('Total: ' . cache()->cachePool()->count());
    }
}