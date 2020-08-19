<?php


namespace ADelf\LeaderServer\Cache;

use ADelf\LeaderServer\Contracts\Cache\CacheDriver;
use ADelf\LeaderServer\Contracts\Cache\CacheInterface;

class CacheController implements CacheInterface
{
    protected $pool;

    public function __construct(CacheDriver $driver)
    {
        $this->pool = $driver;
    }

    public function getDriver(): string
    {
        return config()->get('cache.driver');
    }

    public function cachePool(): CacheDriver
    {
        return $this->pool;
    }
}