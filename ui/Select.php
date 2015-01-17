<?php
namespace lampfire\ui;

class Select extends Element implements HasClosingTag {
	protected $content = '';

	/** Combined getter / setter for $this->content. IMPORTANT NOTE: Use of add_object() is recommended over this method for adding option tags to a <select /> input.
	 *  @param string content
	 *  @return mixed A string if a value for content is not passed, the current instance of the object if it is.
	 */
	public function content ( $content = null ) {
		if ( null !== $content ) {
			$this->content = $content;
			return $this;
		}
		return $this->content;
	}

	/** Add an option to the Select control.
	 *  @param Option $option An Option object to add to the Select control.
	 *  @param Select A reference to the instance of this object.
	 */
	public function add_option( Option $option ) {
		$this->content .= (string) $option;

		return $this;
	}

	/** This method adds options from an array based off of $key => $value pairs. Array keys become the value of the @value attibute and array values are assigned to the content of the option. $select_value should be set to the value of the $key that you wish to have selected as the value of the control.
	 *	@param array $data_array $key => $value pairs that repectively become @value attribute values and content of the created <option /> tags.
	 *	@param mixed $select_value The value of the $key that should be tagged as selected.
	 *  @return Select A reference to the instance of this object.
	 *  @todo Add support for multiple select boxes.
	 */
	public function add_options_from_array ( $data_array, $select_value = null ) {
		foreach ( $data_array as $option_value => $option_content ) {
			$option = new Option();
			$option->value( $option_value )
				->content( $option_content );
			if ( null !== $select_value && $select_value == $option_value ) {
				$option->selected( true );
			}

			$this->add_option( $option );
		}

		return $this;
	}

	protected $multiple = '';

	/** Combined getter / setter for $this->multiple
	 *  @param mixed|boolean Any truthy value selects the option. Any falsey value unselects it.
	 *  @return boolean If a value for $multiple is not passed, returns true if the option is multiple, false if it is not. If no value for $multiple is passed, returns the current instance of the object.
	 */
	public function multiple ( $multiple = true ) {
		$this->multiple = $multiple ? 'multiple' : '';

		return (boolean) $this->multiple;
	}


	function __construct() {
		parent::__construct();

		$this->element_name = 'select';
	}

	public function __toString() {
		$string_value = "<{$this->element_name} "; 

		if ( !empty( $this->multiple ) ) {
			$string_value .= "multiple=\"{$this->multiple}\" ";
		}

		if ( !empty( $this->name ) ) {
			$string_value .= "name=\"{$this->name}\" ";
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
