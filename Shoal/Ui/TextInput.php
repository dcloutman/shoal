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
	 * Returns a string of attibutes. Can be called by inheriting classes for consistent behavior.
	 * @return string A string of attributes for use in an opening or self closing HTML tag.
	 */
	public function getAttributeString () {
		$attributeString = '';

		$attributeString .= parent::getAttributeString();

		if ( !empty( $this->placeholder ) ) {
			$attributeString .= "placeholder=\"{$this->placeholder}\" ";
		}

		if ( !empty( $this->maxlength ) ) {
			$attributeString .= "maxlength=\"{$this->maxlength}\" ";
		}

		if ( !empty( $this->size ) ) {
			$attributeString .= "size=\"{$this->size}\" ";
		}

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
