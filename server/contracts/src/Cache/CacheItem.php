<?php


namespace ADelf\LeaderServer\Contracts\Cache;


use Psr\Cache\CacheItemInterface;

interface CacheItem extends CacheItemInterface
{
    /**
     * Confirm that the resulting search is a cache hit.
     *
     * @param bool $hit
     * @return void
     *   The value corresponding to this cache item's key, or null if not found.
     */
    public function hit(bool $hit): void;
}