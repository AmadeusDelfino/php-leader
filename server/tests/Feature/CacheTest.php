<?php


namespace Feature;


use ADelf\LeaderServer\Services\CacheService;
use Tests\TestBase;

class CacheTest extends TestBase
{
    public function test_set_and_get_from_cache(): void
    {
        $cache = new CacheService();
        $cache->set('foo', 'bar');
        $this->assertEquals($cache->get('foo'), 'bar');
    }

    public function test_delete_from_cache(): void
    {
        $cache = new CacheService();
        $cache->set('foo', 'bar');
        $cache->delete('foo');
        $this->assertNull($cache->get('foo'));
    }

    public function test_deferred_cache(): void
    {
        $cache = new CacheService();
        $transactionKey = $cache->startTransaction();
        $cache->setDeferred($transactionKey, 'foo_deferred', 'bar');
        $this->assertNull($cache->get('foo_deferred'));
        $cache->commit($transactionKey);
        $this->assertEquals($cache->get('foo_deferred'), 'bar');
    }

    public function test_deferred_rollback(): void
    {
        $cache = new CacheService();
        $transactionKey = $cache->startTransaction();
        $cache->setDeferred($transactionKey, 'foo_deferred', 'bar');
        $cache->rollback($transactionKey);
        $this->assertNull($cache->get('foo_deferred'));
    }

    public function test_count_cached_items(): void
    {
        $cache = new CacheService();
        $cache->set('foo_count', 'bar');
        $this->assertEquals($cache->count(), 1);
    }

    public function test_commit_transaction_id_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cache = new CacheService();
        $cache->commit('1');
    }

    public function test_rollback_transaction_id_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cache = new CacheService();
        $cache->rollback('1');
    }

    public function test_set_deferred_transaction_id_validation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cache = new CacheService();
        $cache->setDeferred('1', 'foo', 'bar');
    }

    public function test_expires_at(): void
    {
        $cache = new CacheService();
        $cache->set('foo_expires', 'bar', 10);

        $this->assertIsBool(true);
    }
}