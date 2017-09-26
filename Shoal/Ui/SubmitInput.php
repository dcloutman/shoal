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
class SubmitInput extends Input {

    /**
     * Create an SubmitInput object.
     */
    function __construct() {
        parent::__construct();

        $this->type = 'submit';
    }

    /**
     * Get HTML fragment.
     * @return string
     */
    public function __toString () {
        $stringValue = "<{$this->elementName} ";
        $stringValue .= parent::getAttributeString();
        $stringValue .= '/>';

        return $stringValue;
    }
}
