<?php
/**
 * \Shoal\Ui\TextInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the text input.
 */
class TextInput extends Input {

	/**
	 * @var string $size
	 * @internal
	 */
	protected $size = '';

	/** 
	 * Combined getter / setter for $this->size
	 * @param string $size
	 * @return mixed A string if a value for size is not passed, the current instance of the object if it is.
	 */
	public function size ( $size = null ) {
		if ( null !== $size ) {
			$this->size = $size;
			return $this;
		}
		return $this->size;
	}


	/** 
	 * @var string $maxlength
	 * @internal
	 */
	protected $maxlength = '';

	/** 
	 * Combined getter / setter for $this->maxlength
	 * @param string $maxlength
	 * @return mixed A string if a value for maxlength is not passed, the current instance of the object if it is.
	 */
	public function maxlength ( $maxlength = null ) {
		if ( null !== $maxlength ) {
			$this->maxlength = $maxlength;
			return $this;
		}
		return $this->maxlength;
	}

	
	/**
	 * Create a TextInput object.
	 */
	function __construct() {
		parent::__construct();

		$this->type = 'text';
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

		if ( !empty( $this->placeholder ) ) {
			$string_value .= "placeholder=\"{$this->placeholder}\" ";
		}

		if ( !empty( $this->maxlength ) ) {
			$string_value .= "maxlength=\"{$this->maxlength}\" ";
		}

		if ( !empty( $this->size ) ) {
			$string_value .= "size=\"{$this->size}\" ";
		}

		if ( !empty( $this->value ) ) {
			$string_value .= "value=\"{$this->value}\" ";
		}


		$string_value .= '/>';

		return $string_value;
	}
}
