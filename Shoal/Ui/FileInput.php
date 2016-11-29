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
		$stringValue = "<{$this->elementName} ";

		if ( !empty( $this->name ) ) {
			$stringValue .= "name=\"{$this->name}\" ";
		}

		if ( !empty( $this->id ) ) {
			$stringValue .= "id=\"{$this->id}\" ";
		}

		if ( !empty( $this->type ) ) {
			$stringValue .= "type=\"{$this->type}\" ";
		}

		if ( !empty( $this->class ) ) {
			$stringValue .= "class=\"{$this->class}\" ";
		}

		if ( !empty( $this->style ) ) {
			$stringValue .= "style=\"{$this->style}\" ";
		}

		if ( !empty( $this->placeholder ) ) {
			$stringValue .= "placeholder=\"{$this->placeholder}\" ";
		}

		if ( !empty( $this->accept ) ) {
			$stringValue .= "accept=\"{$this->accept}\" ";
		}

		if ( !empty( $this->size ) ) {
			$stringValue .= "size=\"{$this->size}\" ";
		}

		if ( !empty( $this->value ) ) {
			$stringValue .= "value=\"{$this->value}\" ";
		}


		$stringValue .= '/>';

		return $stringValue;
	}
}
