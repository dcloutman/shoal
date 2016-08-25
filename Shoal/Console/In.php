<?php
namespace Shoal\Console;

/** A simple class to get line input from the console.
 */
class In {
	protected $in;
	protected $last_input = '';
	protected $max_len = 8196;

	public function __construct() {
		$this->in = fopen('php://stdin', 'r');
	}

	/** Get a line of input.
	 *  @param string $prompt An optional line of input.
	 *  @return string The line of input with leading and trailing whitespace removed.
	 */
	public function getln ( $prompt = '' ) {
		echo $prompt;
		$text = trim(fgets($this->in, $this->max_len));

		$this->last_input = $text;
		return $this->last_input;
	}

	public function __toString() {
		return $this->in;
	}
}

