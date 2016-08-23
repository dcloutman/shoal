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
		if ( !$this->isSessionFlashSet() ) {
			$this->initializeSesssionFlash();
		}
	}

	public function addError ( $message, $fields = [] ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['errors'][] = $message;
		foreach ( $fields as $field ) {
			$_SESSION[self::$flashSessionPrefix . '.flash']['error_fields'][] = $field;
		}
	}

	public function addWarning ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['warnings'][] = $message;
	}

	public function addSuccess ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['successes'][] = $message;
	}

	public function addInfo ( $message ) {
		$_SESSION[self::$flashSessionPrefix . '.flash']['info'][] = $message;
	}

	public function getFlash () {
		$return_value = $_SESSION[self::$flashSessionPrefix . '.flash']; //Makes a copy.
		return $return_value;
	}

	public function getAndClearFlash () {
		$return_value = false;
		if ( $this->isSessionFlashSet() ) {
			$return_value = $this->getFlash();
		}

		$this->clearFlash();
		return $return_value;
	}

	private function isSessionFlashSet () {
		return isset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
	}

	public function clearFlash () {
		unset( $_SESSION[self::$flashSessionPrefix . '.flash'] );
	}

	private function initializeSesssionFlash () {
		$_SESSION[self::$flashSessionPrefix . '.flash'] = [
			'errors' => [],
			'error_fields' => [],
			'warnings' => [],
			'info' => [],
			'successes' => [],
		];		
	}

}
