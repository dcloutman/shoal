<?php
namespace Shoal\Util;

/** Wraps flash routines that read and write into $_SESSION into an object.
 */
class SessionFlash {
	// A unique prefix for flash $_SESSION elements.
	protected static  $flashSessionPrefix = 'shoal';

	public static function setSessionFlashPrefix ($prefix) {
		self::$flashSessionPrefix = $prefix;
	}

	public static function getSessionFlashPrefix () {
		return self::$flashSessionPrefix;
	}

	function __construct () {
		if ( !$this->is_session_flash_set() ) {
			$this->initialize_sesssion_flash();
		}
	}

	public function add_error ( $message, $fields = [] ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['errors'][] = $message;
		foreach ( $fields as $field ) {
			$_SESSION[self::$flashSessionPrefix . '.flash']['error_fields'][] = $field;
		}
	}

	public function add_warning ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['warnings'][] = $message;
	}

	public function add_success ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['successes'][] = $message;
	}

	public function add_info ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['info'][] = $message;
	}

	public function get_flash () {
		$return_value = $_SESSION[self::$flashSessionPrefix . '.flash']; //Makes a copy.
		return $return_value;
	}

	public function get_and_clear_flash () {
		$return_value = false;
		if ( $this->is_session_flash_set() ) {
			$return_value = $this->get_flash();
		}

		$this->clear_flash();
		return $return_value;
	}

	private function is_session_flash_set () {
		return isset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
	}

	public function clear_flash () {
		unset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
	}

	private function initialize_sesssion_flash () {
		$_SESSION[self::$flashSessionPrefix . '.flash'] = [
			'errors' => [],
			'error_fields' => [],
			'warnings' => [],
			'info' => [],
			'successes' => [],
		];		
	}

}
