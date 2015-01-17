<?php
namespace lampfire\ui;

class Option extends Element implements HasClosingTag {
	use ContentTrait;

	protected $value = '';

	/** Combined getter / setter for $this->value
	 *  @param string value
	 *  @return mixed A string if a value for value is not passed, the current instance of the object if it is.
	 */
	public function value ( $value = null ) {
		if ( null !== $value ) {
			$this->value = $value;
			return $this;
		}
		return $this->value;
	}


	protected $selected = '';

	/** Combined getter / setter for $this->selected
	 *  @param mixed|boolean Any truthy value selects the option. Any falsey value unselects it.
	 *  @return boolean If a value for $selected is not passed, returns true if the option is selected, false if it is not. If no value for $selected is passed, returns the current instance of the object.
	 */
	public function selected ( $selected = null ) {
		if ( $selected !== null ) {
			$this->selected = $selected ? 'selected' : '';
		}

		return (boolean) $this->selected;
	}


	function __construct() {
		parent::__construct();

		$this->element_name = 'option';
	}


	public function __toString() {
		$string_value = "<{$this->element_name} "; 

		if ( !empty( $this->value ) ) {
			$string_value .= "value=\"{$this->value}\" ";
		}

		if ( !empty( $this->selected ) ) {
			$string_value .= "selected=\"{$this->selected}\" ";
		}

		if ( !empty( $this->id ) ) {
			$string_value .= "id=\"{$this->id}\" ";
		}

		if ( !empty( $this->class ) ) {
			$string_value .= "class=\"{$this->class}\" ";
		}

		if ( !empty( $this->style ) ) {
			$string_value .= "style=\"{$this->style}\" ";
		}

		$string_value .= ">$this->content</{$this->element_name}>";
	
		return $string_value;
	}

}
