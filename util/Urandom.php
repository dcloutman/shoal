<?php
namespace lampfire\util;

/** This is a singleton class that generates random values from a filestream from /dev/urandom. These values
 *  are more cryptographically secure that values generated by the rand() function or from /dev/random.
 */
class Urandom {
	private static $instance = null;

	protected $urandom_rsc = null;

	/** Opens /dev/urandom if not already open.
	 */
	public function open_urandom () {
		if ( null === $this->urandom_rsc || !is_resource( $this->urandom_rsc ) ) {
			$this->urandom_rsc = fopen('/dev/urandom', 'rb');
		}
	}

	/** Returns the current handle for /dev/urandom.
	 *  @return resource
	 */
	public function get_urandom_rsc () {
		return $this->urandom_rsc;
	}

	/** Gets a random stream of binary values.
	 *  @param integer $length The number of bytes read. Default is 4096.
	 *  @return string A stream of random binary values.
	 */
	public function get_binary_stream ( $length = 4096 ) {
		$random_binary = fread( $this->urandom_rsc, $length );
		return $random_binary;
	}

	/** Generates a random sha1 hash based off a /dev/urandom binary string.
	 *  @param $stream_length Default is 4096 bytes. Longer binary streams have more possible sha1 values but take longer to generate.
	 */
	public function get_random_sha1 ( $stream_length = 4096 ) {
		return sha1( $this->get_binary_stream( $stream_length ) );
	}

	/** Generates a random md5 hash based off a /dev/urandom binary string.
	 *  @param $stream_length Default is 4096 bytes. Longer binary streams have more possible md5 values but take longer to generate.
	 */
	public function get_random_md5 ( $stream_length = 4096 ) {
		return md5( $this->get_binary_stream( $stream_length ) );
	}

	private function __construct () {
		$this->open_urandom();
	}

	/** Returns the single instance of the lampfire\util\Urandom class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		self::$instance->open_urandom(); // Ensure that urandom is open each time the singleton is requested.
		return self::$instance;
	}

	private function __clone () {}
}


