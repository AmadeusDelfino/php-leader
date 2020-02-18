<?php


namespace ADelf\LeaderServer\Contracts\Cache;


use Psr\Cache\CacheItemPoolInterface;

interface CacheInterface
{
    public function getDriver(): string;

    public function cachePool(): CacheDriver;
}