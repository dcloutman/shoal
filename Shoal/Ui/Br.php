<?php
/**
 * \Shoal\Ui\Br
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A UI class implementing the &lt;br /&gt; element.
 */
class Br extends Element {

    /**
     * Create a Br object.
     */
    function __construct() {
        $this->elementName = 'br';
    }

    /**
     * Returns a string of attibutes. Can be called by inheriting classes for consistent behavior.
     * @return string A string of attributes for use in an opening or self closing HTML tag.
     */
    public function getAttributeString () {
        $attributeString = '';
        $attributeString .= parent::getAttributeString();
        return $attributeString;
    }

    /**
     * Get HTML fragment.
     * @return string
     */
    public function __toString () {
        $stringValue = "<{$this->elementName} ";
        $stringValue .= $this->getAttributeString();
        $stringValue .= '/>';

        return $stringValue;
    }
}
