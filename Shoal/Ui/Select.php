<?php
/**
 * \Shoal\Ui\Select
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the &lt;select /&gt; element.
 */
class Select extends Element implements HasClosingTag {
	/**
	 * @var string $content
	 * @internal
	 */
	protected $content = '';

	/**
	 * Combined getter / setter for $this->content. IMPORTANT NOTE: The use of the addObject() method is recommended over this method for adding option tags to a <select /> input.
	 * @param string content
	 * @return mixed A string if a value for content is not passed, the current instance of the object if it is.
	 */
	public function content ( $content = null ) {
		if ( null !== $content ) {
			$this->content = $content;
			return $this;
		}
		return $this->content;
	}

	/**
	 * Add an option to the Select control.
	 * @param Option $option An Option object to add to the Select control.
	 * @param Select A reference to the instance of this object.
	 */
	public function addOption( Option $option ) {
		$this->content .= (string) $option;

		return $this;
	}

	/**
	 * This method adds options from an array based off of $key => $value pairs. Array keys become the value of the @value attibute and array values are assigned to the content of the option. $selectValue should be set to the value of the $key that you wish to have selected as the value of the control.
	 * @param array $dataArray $key => $value pairs that repectively become @value attribute values and content of the created <option /> tags.
	 * @param mixed $selectValue The value of the $key that should be tagged as selected.
	 * @return Select A reference to the instance of this object.
	 * @todo Add support for multiple select boxes.
	 */
	public function addOptionsFromArray ( $dataArray, $selectValue = null ) {
		foreach ( $dataArray as $optionValue => $optionContent ) {
			$option = new Option();
			$option->value( $optionValue )
				->content( $optionContent );
			if ( null !== $selectValue && $selectValue == $optionValue ) {
				$option->selected( true );
			}

			$this->addOption( $option );
		}

		return $this;
	}

	/**
	 * @var string $class
	 * @internal
	 */
	protected $multiple = '';

	/**
	 * Combined getter / setter for $this->multiple
	 * @param mixed|boolean Any truthy value selects the option. Any falsey value unselects it.
	 * @return boolean If a value for $multiple is not passed, returns true if the option is multiple, false if it is not. If no value for $multiple is passed, returns the current instance of the object.
	 */
	public function multiple ( $multiple = true ) {
		$this->multiple = $multiple ? 'multiple' : '';

		return (boolean) $this->multiple;
	}


	/**
	 * Create a select object.
	 */
	function __construct() {
		parent::__construct();

		$this->elementName = 'select';
	}

	/** 
	 * Get HTML fragment.
	 * @return string
	 */
	public function __toString() {
		$stringValue = "<{$this->elementName} "; 

		if ( !empty( $this->multiple ) ) {
			$stringValue .= "multiple=\"{$this->multiple}\" ";
		}

		if ( !empty( $this->name ) ) {
			$stringValue .= "name=\"{$this->name}\" ";
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
