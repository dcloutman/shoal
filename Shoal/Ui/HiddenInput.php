<?php
/**
 * \Shoal\Ui\HiddenInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * Implements hidden fields.
 */
class HiddenInput extends Input {

    /**
     * Create an HiddenInput object.
     */
    function __construct() {
        parent::__construct();

        $this->type = 'hidden';
    }

    /**
     * Get HTML fragment.
     * @return string
     */
    public function __toString () {
        $stringValue = "<{$this->elementName} type=\"{$this->type}\" ";

        if (!empty($this->name)) {
            $stringValue .= "name=\"{$this->name}\" ";
        }

        if (!empty($this->id)) {
            $stringValue .= "id=\"{$this->id}\" ";
        }
        $stringValue .= "value=\"{$this->value}\" />";

        return $stringValue;
    }
}
