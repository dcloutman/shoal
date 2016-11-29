<?php
/**
 * \Shoal\Ui\CheckableInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/** A UI class for implementing checkboxes.
 */
class CheckboxInput extends CheckableInput {

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString () {
		$stringValue = "<{$this->elementName} ";

		if ( !empty( $this->name ) ) {
			$stringValue .= "name=\"{$this->name}\" ";
		}

		if ( !empty( $this->id ) ) {
			$stringValue .= "id=\"{$this->id}\" ";
		}

		if ( !empty( $this->class ) ) {
			$stringValue .= "class=\"{$this->class}\" ";
		}

		if ( !empty( $this->style ) ) {
			$stringValue .= "style=\"{$this->style}\" ";
		}

		if ( !empty( $this->size ) ) {
			$stringValue .= "size=\"{$this->size}\" ";
		}

		if ( !empty( $this->type ) ) {
			$stringValue .= "type=\"{$this->type}\" ";
		}

		if ( !empty( $this->value ) ) {
			$stringValue .= "value=\"{$this->value}\" ";
		}

		if ( $this->checked ) {
			$stringValue .= "checked=\"checked\" ";
		}

		$stringValue .= '/>';

		return $stringValue;
	}

	/**
	 * Create a Checkbox object.
	 */
	function __construct() {
		$this->type = 'checkbox';

		parent::__construct();
	}
}
