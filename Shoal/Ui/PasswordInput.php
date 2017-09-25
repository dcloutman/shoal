<?php
/**
 * \Shoal\Ui\PasswordInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;


/**
 * A UI class implementing the password input.
 */
class PasswordInput extends TextInput {

    /**
     * Create a PasswordInput object.
     */
    function __construct() {
        parent::__construct();

        $this->type = 'password';
    }

}
