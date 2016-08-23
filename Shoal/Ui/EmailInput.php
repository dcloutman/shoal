<?php
namespace Shoal\Ui;

/** This is an HTML 5 specific input for email addresses.
 */
class EmailInput extends TextInput {

	function __construct() {
		parent::__construct();

		$this->type = 'email';
	}

}
