<?php
/**
 * \Shoal\Console\In
 * @author David Cloutman
 * @package \Shoal\Console
 * @license MIT
 */

namespace Shoal\Console;


/**
 * A simple class to get line input from the console.
 */
class In {
	/**
	 * @var resource $in A file resource pointed at STDIN.
	 * @internal
	 */
	protected $in;

	/**
	 * @var string $lastInput The last line of input read from STDIN.
	 * @internal
	 */
	protected $lastInput = '';

	/**
	 * @var integer $maxLen The maximum number of bytes to read from STDIN
	 * @internal
	 */
	protected $maxLen = 8196;

	/**
	 * Create an new intance.
	 */
	public function __construct() {
		$this->in = fopen('php://stdin', 'r');
	}

	/**
	 * Get a line of input.
	 * @param string $prompt An optional line of input.
	 * @return string The line of input with leading and trailing whitespace removed.
	 */
	public function getln ( $prompt = '' ) {
		echo $prompt;
		$text = trim(fgets($this->in, $this->maxLen));

		$this->lastInput = $text;
		return $this->lastInput;
	}

	/**
	 * Generates a sanitized string based on the last line of input.
	 */
	public function __toString() {
		return $this->lastInput;
	}
}

