<?php


namespace ADelf\LeaderServer\Cache\Drivers;


use ADelf\LeaderServer\Cache\Item;
use ADelf\LeaderServer\Contracts\Cache\CacheDriver;
use ADelf\LeaderServer\Contracts\Cache\CacheItem;

class ArrayCacheDriver implements CacheDriver
{
    protected $items = [];
    protected $queue = [];

    /**
     * @inheritDoc
     */
    public function getItem($key): CacheItem
    {
        return $this->items[$key] ?? new Item();
    }

    /**
     * @inheritDoc
     */
    public function hasItem($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        $this->items = [];

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteItem($key): bool
    {
        unset($this->items[$key]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function save(CacheItem $item): bool
    {
        $item->hit(true);
        $this->items[$item->getKey()] = $item;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function saveDeferred(CacheItem $item): bool
    {
        $this->queue[$item->getKey()] = $item;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        $this->items = array_merge($this->items, $this->queue);
    }
}