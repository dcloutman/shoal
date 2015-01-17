<?php
namespace lampfire\ui;
class HiddenInput extends Input {
	
	function __construct() {
		parent::__construct();

		$this->type = 'hidden';
	}


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
