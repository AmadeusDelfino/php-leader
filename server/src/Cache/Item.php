<?php


namespace ADelf\LeaderServer\Cache;


use ADelf\LeaderServer\Contracts\Cache\CacheItem;
use DateInterval;
use DateTimeImmutable;

class Item implements CacheItem
{
    protected $key;
    protected $value;
    protected $hit = false;
    protected $expiresAt;

    public function __construct($key, $value, $expiresAt = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->expiresAfter($expiresAt);
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        return $this->value;
    }

    public function hit(bool $hit): void
    {
        $this->hit = true;
    }

    /**
     * @inheritDoc
     */
    public function isHit(): bool
    {
        return $this->hit;
    }

    /**
     * @inheritDoc
     */
    public function set($value): void
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function expiresAt($expiration): DateTimeImmutable
    {
        return new DateTimeImmutable($this->expiresAt);
    }

    /**
     * @inheritDoc
     */
    public function expiresAfter($time): void
    {
        if($time instanceof DateInterval) {
            $this->expiresAt = (new \DateTime())->add($time);
        }

        if(is_int($time)) {
            $this->expiresAt = (new \DateTime())->add((new DateInterval('PT'.$time.'S')));
        }

        if($time === null) {
            $this->expiresAt = null;
        }
    }
}