<?php
namespace Shoal\Ui;


class EmailInput extends TextInput {

	function __construct() {
		parent::__construct();

		$this->type = 'email';
	}

}
