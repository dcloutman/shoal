<?php
/**
 * \Shoal\Ui\Label
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the <label /> element.
 */
class Label extends Element implements HasClosingTag {
	use ContentTrait;

	/**
	 * @var string $for
	 * @internal
	 */
	protected $for = '';

	/**
	 * Combined getter / setter for $this->for
	 * @param string|lampfire\ui\Element $for Uses the id value of an Element object or assigns the string if a string is passed.
	 * @return mixed A string if a value for for is not passed, the current instance of the object if it is.
	 */
	public function forAtt ( $for = null ) {
		if ( null !== $for ) {
			if ( $for instanceof Element ) {
				$this->for = $for->id();
			} else {
				$this->for = $for;
			}

			return $this;
		}
		return $this->for;
	}

	/**
	 * Create a Label object.
	 */
	function __construct() {
		parent::__construct();

		$this->elementName = 'label';
	}

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString() {
		$stringValue = "<{$this->elementName} "; 

		if ( !empty( $this->for ) ) {
			$stringValue .= "for=\"{$this->for}\" ";
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
