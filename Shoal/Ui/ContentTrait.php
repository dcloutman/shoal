<?php
/**
 * \Shoal\Ui\ContentTrait
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * A default implementation that handles the content inside any non-self-closing tag. Designed to pair with the interface declared in HasClosingTag.
 */
trait ContentTrait {
    /**
     * @var string $content
     * @internal
     */
    protected $content = '';

    /**
     * Combined getter / setter for $this->content
     * @param string $content
     * @return mixed A string if a value for content is not passed, the current instance of the object if it is.
     */
    public function content ( $content = null ) {
        if ( null !== $content ) {
            $this->content = $content;
            return $this;
        }
        return $this->content;
    }
}
