<?php
/**
 * \Shoal\Ui\FileInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class for implementing checkboxes.
 */
class FileInput extends Input {

	/**
	 * @var string $accept
	 * @internal
	 */
	protected $accept;

	/**
	 * Combined getter / setter for $this->accept, which specifies which file mime types are acceptable.
	 * @param string $accept
	 * @return mixed A string if a value for accept is not passed, the current instance of the object if it is.
	 */
	public function accept ( $accept = null ) {
		if ( null !== $accept ) {
			$this->accept = $accept;
			return $this;
		}
		return $this->accept;
	}

	/**
	 * Create a FileInput object.
	 */
	function __construct() {
		parent::__construct();

		$this->type = 'file';
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

		if ( !empty( $this->accept ) ) {
			$string_value .= "accept=\"{$this->accept}\" ";
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
