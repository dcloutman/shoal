<?php
/**
 * \Shoal\Cache\Memcached\MemcachedPool
 * @author David Cloutman
 * @package \Shoal\Cache\Memcached
 * @license MIT
 */

namespace Shoal\Cache\Memcached;

/** 
 * Configuration of MemcachedFactory is done through the MemcachedPool class. For development purposes, a single call to
 * MemcachedPool::addServer() with no parameters is sufficient. Multiple calls will build out the pool. These calls should 
 * generally be made in the configuration or bootstrapping section of the application prior to the first call of
 * MemcachedFactory::getMemcached().
 */
class MemcachedPool {
	/**
	 * @var array $servers
	 * @internal
	 */
	protected static $servers = [];

	/**
	 * Add a server to the pool.
	 * @param string $host The domain or IP address of the server.
	 * @param integer $port The port of the server.
	 * @param integer $weight
	 */
	public static function addServer($host = '127.0.0.1', $port = 11211, $weight = 100) {
		// 'I.P. Address', Port, Weight
		self::$servers[] = [$host, $port, $weight];
	}


	/**
	 * Returns the entire server pool configuration.
	 * @param array
	 */
	public static function getServers () {
		return self::$servers;
	}

	/**
	 * Remove all servers from the server pool configuration.
	 * @return array
	 */
	public static function resetServers () {
		self::$servers = [];
	}
}

