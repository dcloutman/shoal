<?php
/**
 * \Shoal\Ui\Br
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the <br /> element.
 */
class Br extends Element {

	/**
	 * Create a Br object.
	 */
	function __construct() {
		$this->element_name = 'br';
	}

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString () {
		$string_value = "<{$this->element_name} "; 

		if ( !empty( $this->name ) ) {
			$string_value .= "name=\"{$this->name}\" ";
		}

		if ( !empty( $this->id ) ) {
			$string_value .= "id=\"{$this->id}\" ";
		}

		if ( !empty( $this->type ) ) {
			$string_value .= "type=\"{$this->type}\" ";
		}

		if ( !empty( $this->class ) ) {
			$string_value .= "class=\"{$this->class}\" ";
		}

		if ( !empty( $this->style ) ) {
			$string_value .= "style=\"{$this->style}\" ";
		}

		$string_value .= '/>';

		return $string_value;
	}
}
