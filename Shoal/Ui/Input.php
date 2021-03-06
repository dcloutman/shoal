<?php
/**
 * \Shoal\Ui\Input
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * An abstract &lt;input /&gt; element.
 */
abstract class Input extends Element {
	/**
	 * @var string $type
	 * @internal
	 */
	protected $type = '';

	/**
	 * Combined getter / setter for $this->type
	 * @param string type
	 * @return mixed A string if a value for type is not passed, the current instance of the object if it is.
	 */
	public function type ( $type = null ) {
		if ( null !== $type ) {
			$this->type = $type;
			return $this;
		}
		return $this->type;
	}

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
	 * @var string $placeholder
	 * @internal
	 */
	protected $placeholder = '';

	/**
	 * Combined getter / setter for $this->placeholder
	 * @param string placeholder
	 * @return mixed A string if a value for placeholder is not passed, the current instance of the object if it is.
	 */
	public function placeholder ( $placeholder = null ) {
		if ( null !== $placeholder ) {
			$this->placeholder = $placeholder;
			return $this;
		}
		return $this->placeholder;
	}

	/**
	 * Returns a string of attibutes. Can be called by inheriting classes for consistent behavior.
	 * @return string A string of attributes for use in an opening or self closing HTML tag.
	 */
	public function getAttributeString () {
		$attributeString = '';

		if ( !empty( $this->type ) ) {
			$attributeString .= "type=\"{$this->type}\" ";
		}

		if ( !empty($this->value) ) {
			$attributeString .= "value=\"{$this->value}\" ";
		}

		$attributeString .= parent::getAttributeString();

		return $attributeString;
	}

	/**
	 * A parent constructor to be called by all subclasses of Input.
	 */
	function __construct() {
		$this->elementName = 'input';
	}
}
