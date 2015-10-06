<?php
namespace \Lampfire\Shoal\Ui;

/** A UI class for implementing radio buttons.
 */
class RadioInput extends CheckableInput {

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

		if ( !empty( $this->size ) ) {
			$string_value .= "size=\"{$this->size}\" ";
		}

		if ( !empty( $this->value ) ) {
			$string_value .= "value=\"{$this->value}\" ";
		}

		if ( $this->checked ) {
			$string_value .= "checked=\"checked\" ";
		}

		$string_value .= '/>';

		return $string_value;
	}

	function __construct() {
		$this->type = 'radio';

		parent::__construct();
	}
}
