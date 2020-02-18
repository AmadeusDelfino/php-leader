<?php


namespace ADelf\LeaderServer\Cache\Factories;


use ADelf\LeaderServer\Cache\CacheController;
use ADelf\LeaderServer\Cache\Drivers\ArrayCacheDriver;

class ArrayFactory
{
    public function __invoke()
    {
        return new CacheController(new ArrayCacheDriver());
    }
}