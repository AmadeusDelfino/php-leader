<?php


namespace ADelf\LeaderServer\RequestHandlers\Console\Cache;

use ADelf\LeaderServer\RequestHandlers\Console\Command;
use Clue\React\Stdio\Stdio;

class FlushCacheHandler extends Command
{
    protected $description = 'Clear all cache items';

    protected $args = [
        'deferred' => [
            'required' => false,
            'description' => 'If true, it also clears deferred items',
            'default' => false,
        ]
    ];

    protected function execute(Stdio $stdio): void
    {
        $flushDeferred = $this->args('deferred')->value();
        cache()->cachePool()->clear();
    }
}