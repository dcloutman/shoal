<?php
/**
 * \Shoal\Ui\SubmitInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * Creates a submit button for a form.
 */
class SubmitInput extends TextInput {

	/**
	 * Create an SubmitInput object.
	 */
	function __construct() {
		parent::__construct();

		$this->type = 'submit';
	}

}
