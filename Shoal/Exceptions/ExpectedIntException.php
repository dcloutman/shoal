<?php
/**
 * \Shoal\Exceptions\ExpectedIntException
 * @author David Cloutman
 * @package \Shoal\Exceptions
 * @license MIT
 *
 * An exception to be thrown when a variable, argument, etc. is expected to be of the actual type integer, but not when a string representation of an integer is acceptable.
 */

namespace Shoal\Exceptions;

/**
 * Extends PHP's \Exception class.
 */
class ExpectedIntException extends \Exception {
    /**
     * Create an instance of the exception.
     * @param string $message
     * @param integer $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
