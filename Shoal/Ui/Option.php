<?php
/**
 * \Shoal\Ui\Option
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the <option /> element.
 */
class Option extends Element implements HasClosingTag {
	use ContentTrait;
	
	/**
	 * @var string $value
	 * @internal
	 */
	protected $value = '';

	/**
	 * Combined getter / setter for $this->value
	 * @param string value
	 * @return mixed A string if a value for value is not passed, the current instance of the object if it is.
	 */
	public function value ( $value = null ) {
		if ( null !== $value ) {
			$this->value = $value;
			return $this;
		}
		return $this->value;
	}

	
	/**
	 * @var string $selected
	 * @internal
	 */
	protected $selected = '';

	/**
	 * Combined getter / setter for $this->selected
	 * @param mixed|boolean Any truthy value selects the option. Any falsey value unselects it.
	 * @return boolean If a value for $selected is not passed, returns true if the option is selected, false if it is not. If no value for $selected is passed, returns the current instance of the object.
	 */
	public function selected ( $selected = null ) {
		if ( $selected !== null ) {
			$this->selected = $selected ? 'selected' : '';
		}

		return (boolean) $this->selected;
	}


	/**
	 * Create an Object object.
	 */
	function __construct() {
		parent::__construct();

		$this->elementName = 'option';
	}


	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString() {
		$stringValue = "<{$this->elementName} "; 

		if ( !empty( $this->value ) ) {
			$stringValue .= "value=\"{$this->value}\" ";
		}

		if ( !empty( $this->selected ) ) {
			$stringValue .= "selected=\"{$this->selected}\" ";
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

		$stringValue .= ">$this->content</{$this->elementName}>";
	
		return $stringValue;
	}

}
