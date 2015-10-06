<?php
namespace \Lampfire\Shoal\Ui;


class PasswordInput extends TextInput {

	function __construct() {
		parent::__construct();

		$this->type = 'password';
	}

}
