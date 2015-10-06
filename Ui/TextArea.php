<?php
namespace \Lampfire\Shoal\Ui;

class TextArea extends Input implements HasClosingTag {
	use ContentTrait;

	protected $placeholder = '';

	/** Combined getter / setter for $this->placeholder
	 *  @param string placeholder
	 *  @return mixed A string if a value for placeholder is not passed, the current instance of the object if it is.
	 */
	public function placeholder ( $placeholder = null ) {
		if ( null !== $placeholder ) {
			$this->placeholder = $placeholder;
			return $this;
		}
		return $this->placeholder;
	}


	protected $cols = '';

	/** Combined getter / setter for $this->cols
	 *  @param string cols
	 *  @return mixed A string if a value for cols is not passed, the current instance of the object if it is.
	 */
	public function cols ( $cols = null ) {
		if ( null !== $cols ) {
			$this->cols = $cols;
			return $this;
		}
		return $this->cols;
	}


	protected $rows = '';

	/** Combined getter / setter for $this->rows
	 *  @param string rows
	 *  @return mixed A string if a value for rows is not passed, the current instance of the object if it is.
	 */
	public function rows ( $rows = null ) {
		if ( null !== $rows ) {
			$this->rows = $rows;
			return $this;
		}
		return $this->rows;
	}


	protected $maxlength = '';

	/** Combined getter / setter for $this->maxlength
	 *  @param string maxlength
	 *  @return mixed A string if a value for maxlength is not passed, the current instance of the object if it is.
	 */
	public function maxlength ( $maxlength = null ) {
		if ( null !== $maxlength ) {
			$this->maxlength = $maxlength;
			return $this;
		}
		return $this->maxlength;
	}


	function __construct() {
		parent::__construct();

		$this->element_name = 'textarea';
	}


	public function __toString() {
		$string_value = "<{$this->element_name} "; 

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

		if ( !empty( $this->placeholder ) ) {
			$string_value .= "placeholder=\"{$this->placeholder}\" ";
		}

		if ( !empty( $this->cols ) ) {
			$string_value .= "cols=\"{$this->cols}\" ";
		}

		if ( !empty( $this->rows ) ) {
			$string_value .= "rows=\"{$this->rows}\" ";
		}

		if ( !empty( $this->maxlength ) ) {
			$string_value .= "maxlength=\"{$this->maxlength}\" ";
		}



		$string_value .= ">$this->content</{$this->element_name}>";
	
		return $string_value;
	}
}
