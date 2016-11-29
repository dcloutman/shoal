<?php
/**
 * \Shoal\Cache\Memcached\MemcachedSingleton
 * @author David Cloutman
 * @package \Shoal\Cache\Memcached
 * @license MIT
 */

namespace Shoal\Cache\Memcached;


/** This class generates a Memcached (with a 'd') class for the configured server pool. It
 *  requires a configuration class called MemcachedPool (see example above) that should be 
 *  placed in the application's configuration file.
 *
 */
class MemcachedSingleton {
	// These timeframes increment by factors of 4. In practice, these tend to be useful in terms of fine tuning cache times.

	/**
	 * @var integer CACHE_ULTRASHORT 75 seconds
	 * @api
	 */
	const CACHE_ULTRASHORT = 75;

	/**
	 * @var integer CACHE_SHORT 5 minutes
	 * @api
	 */
	const CACHE_SHORT = 300;

	/**
	 * @var integer CACHE_MEDIUM 20 minutes
	 * @api
	 */
	const CACHE_MEDIUM = 1200;

	/**
	 * @var integer CACHE_LONG 1 hour, 20 minutes
	 * @api
	 */
	const CACHE_LONG = 4800;

	/**
	 * @var integer CACHE_ULTRALONG 5 hours, 20 minutes
	 * @api
	 */
	const CACHE_ULTRALONG =  19200;


	// These are based on time frames defined by Memcached itself.
	/**
	 * @var CACHE_MAX 30 days, the Memcached maximum.
	 * @api
	 */
	const CACHE_MAX = 2592000;
	
	/**
	 * @var CACHE_INFINITY Memcached interprets 0 as forever.
	 * @api
	 */
	const CACHE_INFINITY = 0;

	
	// These standard time periods are useful when communicating with your boss.
	
	/**
	 * @var integer CACHE_MINUTE
	 * @api
	 */
	const CACHE_MINUTE = 60;
	
	/**
	 * @var integer CACHE_HOUR
	 * @api
	 */
	const CACHE_HOUR = 3600;
	
	/**
	 * @var integer CACHE_DAY
	 * @api
	 */
	const CACHE_DAY = 14400;
	
	/**
	 * @var integer CACHE_WEEK
	 * @api
	 */
	const CACHE_WEEK = 604800;


	/**
	 * @var \Memcached The singleton instance of the Memcached class.
	 * @internal
	 */
	private static $memcachedInstance = null;

	/**
	 * No, you may not instantiate this class.
	 * @internal
	 */
	private function __construct () {}

	/**
	 * You may not clone a singleton.
	 * @internal
	 */
	private function __clone () {}

	/**
	 * Returns a single instance of Memcached using the servers configured in MemcachedPool.
	 * @return Memcached
	 */
	public static function getMemcached () {
		if ( null === self::$memcachedInstance ) {
			self::$memcachedInstance = new \Memcached();
			if (  0 == count ( self::$memcachedInstance->getServerList() ) ) {
				self::$memcachedInstance->addServers( MemcachedPool::getServers() );
			}
		}
		return self::$memcachedInstance;
	}
}



