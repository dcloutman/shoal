<?php
namespace lampfire\ui;


class PasswordInput extends TextInput {
	
	function __construct() {
		parent::__construct();

		$this->type = 'password';
	}

}
