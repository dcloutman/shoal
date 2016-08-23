<?php
namespace Shoal\Cache\Memcached;


/** This class generates a Memcached (with a 'd') class for the configured server pool. It
 *  requires a configuration class called MemcachedPool (see example above) that should be 
 *  placed in the application's configuration file.
 *
 */
class MemcachedFactory {
	const CACHE_ULTRASHORT = 75;
	const CACHE_SHORT = 300; // 5 minutes
	const CACHE_MEDIUM = 1200; // 20 minutes
	const CACHE_LONG = 4800;	// 1 hour, 20 minutes
	const CACHE_ULTRALONG =  19200; // 5 hours, 20 minutes
	const CACHE_MAX = 2592000; // 30 days, the Memcached maximum.
	const CACHE_INFINITY = 0; // Memcached interprets 0 as forever.

	const CACHE_HOUR = 3600;
	const CACHE_DAY = 14400;
	const CACHE_WEEK = 604800;


	private static $memcachedInstance = null;

	private function __construct () {}

	/** Returns a single instance of Memcached using the servers configured in MemcachedPool.
	 *  @return Memcached
	 */
	public static function getMemcached () {
		if ( null === self::$memcachedInstance ) {
			self::$memcachedInstance = new Memcached();
			if (  0 == count ( self::$memcachedInstance->getServerList() ) ) {
				self::$memcachedInstance->addServers( MemcachedPool::getServers() );
			}
		}
		return self::$memcachedInstance;
	}
}



