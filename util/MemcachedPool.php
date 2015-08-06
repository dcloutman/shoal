<?php
namespace lampfire\util;

/** Configuration of MemcachedFactory is done through defining a MemcachedPool class. The class below
 *  will be created by default if none exists. It can be used as a boilerplate for declaring a correct
 *  configuration for an environment.
 */
if ( !class_exists( 'MemcachedPool' ) ) {
	class MemcachedPool {
		public static $servers = array (
			// 'I.P. Address', Port, Weight
			array( '127.0.0.1', 11211, 100 ) // Defaults to localhost.
		);
	}
}

