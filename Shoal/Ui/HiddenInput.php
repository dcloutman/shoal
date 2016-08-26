<?php
/** 
 * \Shoal\Ui\HiddenInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * Implements hidden fields.
 */
class HiddenInput extends Input {

	/**
	 * Create an HiddenInput object.
	 */
	function __construct() {
		parent::__construct();

		$this->type = 'hidden';
	}

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString () {
		$string_value = "<{$this->element_name} type=\"{$this->type}\" "; 

		if ( !empty( $this->name ) ) {
			$string_value .= "name=\"{$this->name}\" ";
		}

		if ( !empty( $this->id ) ) {
			$string_value .= "id=\"{$this->id}\" ";
		}
		$string_value .= "value=\"{$this->value}\" />";

		return $string_value;
	}
}
