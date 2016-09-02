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
	 * Returns a string of attibutes. Can be called by inheriting classes for consistent behavior.
	 * @return string A string of attributes for use in an opening or self closing HTML tag.
	 */
	public function getAttributeString () {
		$attributeString = '';
		$attributeString .= parent::getAttributeString();
		return $attributeString;
	}

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString () {
		$string_value = "<{$this->element_name} "; 
		$string_value .= $this->getAttributeString();
		$string_value .= '/>';

		return $string_value;
	}
}
