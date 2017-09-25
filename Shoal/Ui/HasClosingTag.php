<?php
/**
 * \Shoal\Ui\HasClosingTag
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * This interface flags elements that have a closing tag, as opposed to self closing elements. This interface may be implemented by the ContentTrait class.
 */
interface HasClosingTag {
    /**
     * Combined getter / setter for $this->content
     * @param string $content
     * @return mixed A string if a value for content is not passed, the current instance of the object if it is.
     */
    public function content();
}
