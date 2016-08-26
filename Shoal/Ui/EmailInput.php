<?php
/**
 * \Shoal\Ui\EmailInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/** This is an HTML 5 specific input for email addresses.
 */
class EmailInput extends TextInput {

	/**
	 * Create an EmailInput object.
	 */
	function __construct() {
		parent::__construct();

		$this->type = 'email';
	}

}
