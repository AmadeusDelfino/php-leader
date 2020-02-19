<?php


namespace ADelf\LeaderServer\Services;


use ADelf\LeaderServer\Cache\Item;
use ADelf\LeaderServer\Contracts\Cache\CacheItem;

class CacheService
{
    public function get(string $key, callable $alternative = null, $expiresAt = null)
    {
        $item = cache()->cachePool()->getItem($key);
        if(!is_callable($alternative) || $item->isHit()) {
            return $item->get();
        }

        $value = $alternative();
        $item = $this->makeCacheItem($key, $value, $expiresAt);
        cache()
            ->cachePool()
            ->save($item);

        return $item->get();
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

    public function startTransaction(): string
    {
        return cache()->cachePool()->transaction();
    }

    public function setDeferred($transactionKey, $key, $value, $expiresAt = null): bool
    {
        return cache()
            ->cachePool()
            ->saveDeferred($transactionKey, $this->makeCacheItem($key, $value, $expiresAt));
    }

    public function flush(): bool
    {
        return cache()
            ->cachePool()
            ->clear();
    }

    public function commit(string $transactionKey): bool
    {
        return cache()
            ->cachePool()
            ->commit($transactionKey);
    }

    public function rollback($transactionKey): bool
    {
        return cache()
            ->cachePool()
            ->rollback($transactionKey);
    }

    protected function makeCacheItem($key, $value, $expiresAt): CacheItem
    {
        return new Item($key, $value, $expiresAt);
    }

    public function count(): int
    {
        return cache()->cachePool()->count();
    }
}