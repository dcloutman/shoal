<?php
/**
 * \Shoal\Struct\Circle\LastCircleNodeException
 *
 * This exception is thrown when an attempt is make to generate an empty circle. A Circle must have one or more nodes.
 *
 * @package \Shoal\Struct\Circle
 * @author David Cloutman
 * @license MIT
 */

namespace Shoal\Struct\Circle;

/**
 * A subclass of \Exception.
 */
class LastCircleNodeException extends \Exception {
    /**
     * Create an instance of the exception.
     * @param string $message
     * @param integer $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'A Circle cannot be made empty. A Circle must have one or more CircleNode elements.';
        }

        parent::__construct($message, $code, $previous);
    }
}
