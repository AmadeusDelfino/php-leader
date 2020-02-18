<?php


namespace ADelf\LeaderServer\Cache;


use ADelf\LeaderServer\Contracts\Cache\CacheInterface;
use ADelf\LeaderServer\Exceptions\CacheDriverNotFoundException;

class CacheFactory
{
    /**
     * @return mixed
     * @throws CacheDriverNotFoundException
     */
    public function __invoke(): CacheInterface
    {
        return $this->getFactory(config()->get('cache.driver'))();
    }

    /**
     * @param string $driver
     * @return mixed
     * @throws CacheDriverNotFoundException
     */
    protected function getFactory(string $driver)
    {
        $driver = config()->get('cache.drivers.' . $driver);
        if(!class_exists($driver)) {
            throw new CacheDriverNotFoundException('Cache driver ' . $driver . ' not found.');
        }

        return new $driver();
    }

}