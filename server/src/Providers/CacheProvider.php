<?php


namespace ADelf\LeaderServer\Providers;


use ADelf\LeaderServer\Cache\CacheFactory;
use ADelf\LeaderServer\Contracts\Foundation\Provider;
use Pimple\Container;

class CacheProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $pimple['cacheController'] = (new CacheFactory())();
    }
}