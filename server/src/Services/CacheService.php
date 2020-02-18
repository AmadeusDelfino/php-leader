<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Cache\Item;
use ADelf\LeaderServer\Contracts\Cache\CacheItem;

class CacheService
{
    public function get(string $key, callable $alternative, $expiresAt = null): CacheItem
    {
        $item = cache()->cachePool()->getItem($key);
        if($item->isHit() || !is_callable($alternative)) {
            return $item;
        }

        $value = $alternative();

        $item = $this->makeCacheItem($key, $value, $expiresAt);
        cache()
            ->cachePool()
            ->save($item);

        return $item;
    }

    public function set(string $key, $value, $expiresAt = null): bool
    {
        return cache()
            ->cachePool()
            ->save($this->makeCacheItem($key, $value, $expiresAt));
    }

    public function delete(string $key): bool
    {
        return cache()->cachePool()->deleteItem($key);
    }

    public function setDeferred($key, $value, $expiresAt): bool
    {
        return cache()
            ->cachePool()
            ->saveDeferred($this->makeCacheItem($key, $value, $expiresAt));
    }

    public function flush(): bool
    {
        return cache()
            ->cachePool()
            ->clear();
    }

    public function commit(): bool
    {
        return cache()
            ->cachePool()
            ->commit();
    }

    public function rollback(): bool
    {
        return cache()
            ->cachePool()
            ->rollback();
    }

    protected function makeCacheItem($key, $value, $expiresAt): CacheItem
    {
        return new Item($key, $value, $expiresAt);

    }
}