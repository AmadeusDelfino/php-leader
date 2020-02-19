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
        return $this->items[$key] ?? new Item(null, null);
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
    public function saveDeferred(string $transactionKey, CacheItem $item): bool
    {
        if (!isset($this->queue[$transactionKey])) {
            throw new \InvalidArgumentException('Transaction ' . $transactionKey . ' not stated');
        }

        $this->queue[$transactionKey][$item->getKey()] = $item;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function commit(string $transactionKey): bool
    {
        if (!isset($this->queue[$transactionKey])) {
            throw new \InvalidArgumentException('Transaction ' . $transactionKey . ' not stated');
        }

        $this->items = array_merge($this->items, $this->queue[$transactionKey]);
        unset($transactionKey-$this->queue[$transactionKey]);

        return true;
    }

    public function rollback(string $transactionKey): bool
    {
        if (!isset($this->queue[$transactionKey])) {
            throw new \InvalidArgumentException('Transaction ' . $transactionKey . ' not stated');
        }

        unset($this->queue[$transactionKey]);

        return true;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function transaction(): string
    {
        $key = uniqid(random_int(0, 9999), true);
        $this->queue[$key] = [];

        return $key;
    }
}