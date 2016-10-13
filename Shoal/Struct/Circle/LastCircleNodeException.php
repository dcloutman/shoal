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

class LastCircleNodeException extends \Exception {
    public function __construct($message = null, $code = 0, \Exception $previous = null) {
        if (empty($message)) {
            $message = 'A Circle cannot be made empty. A Circle must have one or more CircleNode elements.';
        }

        parent::__construct($message, $code, $previous);
    }
}
