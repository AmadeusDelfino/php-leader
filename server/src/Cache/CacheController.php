<?php


namespace ADelf\LeaderServer\Cache;

use ADelf\LeaderServer\Contracts\Cache\CacheDriver;

class CacheController implements \ADelf\LeaderServer\Contracts\Cache\CacheInterface
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