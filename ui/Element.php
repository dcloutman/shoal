<?php
namespace lampfire\ui;

abstract class Element {
	/** @var $id Should be set by the inheriting classes.
	 */
	protected $element_name = '';

	protected $style = '';

	/** Combined getter / setter for $this->style
	 *  @param string style
	 *  @return mixed A string if a value for style is not passed, the current instance of the object if it is.
	 */
	public function style ( $style = null ) {
		if ( null !== $style ) {
			$this->style = $style;
			return $this;
		}
		return $this->style;
	}


	protected $class = '';

	/** Combined getter / setter for $this->class. Called 'css_class' because 'class' is a reserved keyword. :(
	 *  @param string class
	 *  @return mixed A string if a value for class is not passed, the current instance of the object if it is.
	 */
	public function class_att ( $class = null ) {
		if ( null !== $class ) {
			$this->class = $class;
			return $this;
		}
		return $this->class;
	}


	protected $id = '';

	/** Combined getter / setter for $this->id
	 *  @param string id
	 *  @return mixed A string if a value for id is not passed, the current instance of the object if it is.
	 */
	public function id ( $id = null ) {
		if ( null !== $id ) {
			$this->id = $id;
			return $this;
		}
		return $this->id;
	}


	protected $name = null;

	/** Combined getter / setter for $this->name
	 *  @param string name
	 *  @return mixed A string if a value for name is not passed, the current instance of the object if it is.
	 */
	public function name ( $name = null ) {
		if ( null !== $name ) {
			$this->name = $name;
			return $this;
		}
		return $this->name;
	}


	public function __construct() {}
}
