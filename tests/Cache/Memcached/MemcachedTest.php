<?php

use PHPUnit\Framework\TestCase;
use Shoal\Cache\Memcached\MemcachedPool;
use Shoal\Cache\Memcached\MemcachedSingleton;

class MemcachedTest extends TestCase {
    /** General test for the MemcachedPool object, which is used to configure the server pool.
     */
    public function testMemcachedPool () {
        // Skip if Memcached extension is not installed.
        if (!class_exists('\\Memcached')) {
            return false;
        }

        $this->assertEquals([], MemcachedPool::getServers());

        MemcachedPool::addServer(); // Sets for likely development values by default.
        $this->assertEquals([['127.0.0.1', 11211, 100]], MemcachedPool::getServers());

        MemcachedPool::resetServers();
        $this->assertEquals([], MemcachedPool::getServers());

        return true;
    }

    /**
     * @depends testMemcachedPool
     */
    public function testMemcachedSingleton ($args) {
        // Skip if Memcached extension is not installed.
        if (!class_exists('\\Memcached')) {
            return false;
        }

        MemcachedPool::resetServers();
        MemcachedPool::addServer(); // Setup for a typical local server.

        $mc = MemcachedSingleton::getMemcached();

        $this->assertTrue($mc instanceof \Memcached);

        return $mc;
    }
}
