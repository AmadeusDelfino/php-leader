<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Cache;

use ADelf\LeaderServer\RequestHandlers\Console\Command;
use Clue\React\Stdio\Stdio;

class CountCacheHandler extends Command
{
    protected $description = 'Count of cache items';

    public function handler(array $params, Stdio $stdio): void
    {
        $stdio->write('Total: ' . cache()->cachePool()->count());
    }
}