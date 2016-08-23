<?php
namespace Shoal\Cache\Memcached;

/** Configuration of MemcachedFactory is done through the MemcachedPool class. For development purposes, a single call to
 *  MemcachedPool::addServer() with no parameters is sufficient. Multiple calls will build out the pool. These calls should 
 *  generally be made in the configuration or bootstrapping section of the application prior to the first call of
 *  MemcachedFactory::getMemcached().
 */
class MemcachedPool {
	protected static $servers = [];

	public static function addServer($host = '127.0.0.1', $port = 11211, $weight = 100) {
		// 'I.P. Address', Port, Weight
		self::$servers[] = [$host, $port, $weight];
	}


	public static function getServers () {
		return self::$servers;
	}

	public static function resetServers () {
		self::$servers = [];
	}
}

