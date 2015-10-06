<?php
namespace \Lampfire\Shoal\Ui;

/** A parent class for checkboxes and radio buttons or any input that uses a "checked" attibute.
 */
abstract class CheckableInput extends Input {
	protected $checked =  false;

	/** Combined getter / setter for $this->checked
	 *  @param boolen $checked
	 *  @return mixed A boolean if a value for checked is not passed, the current instance of the object if it is.
	 */
	public function checked ( $checked = null ) {
		if ( null !== $checked ) {
			$this->checked = $checked;
			return $this;
		}
		return $this->checked;
	}

	/** Constructor simply calls parent constructor.
	 */
	function __construct () {
		parent::__construct();
	}
}
